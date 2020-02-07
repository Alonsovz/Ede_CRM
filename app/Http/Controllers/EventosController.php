<?php

namespace App\Http\Controllers;

use App\Evento;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use App\CrmAdjuntos;

class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    //listar eventos de la db
    public function getEventos()
    {
        //conexion con COMANDA
        $eventos = DB::connection('comanda')
            ->table('CRM_eventos as e')
            ->leftjoin('CRM_estados_eventos as estado','estado.id','=','e.estado')
            ->select('e.*','estado.nombre as estado')
            ->where('e.usuario_crm',Session::get('usuario_crm'))
            ->orderBy('e.fecha_compromiso','desc')
            ->get();


        return response()->json($eventos);
    }


      //listar eventos de la db
      public function getEventosOtrosUsuarios()
      {
          //conexion con COMANDA
          $eventosCl = DB::connection('calidad')->select("SELECT e.*,ee.nombre as estado, 
          (select alias from comanda_db.dbo.users where id = e.usuario_crm ) as usuario_creacion from 
          comanda_db.dbo.crm_eventos e
          inner join comanda_db.dbo.crm_clientes c on c.empresa = e.cliente
          inner join comanda_db.dbo.users u on u.id = c.usuario_crm
          inner join comanda_db.dbo.CRM_estados_eventos as ee on ee.id = e.estado
           where u.alias = ? and e.usuario_crm != 
            (select id from comanda_db.dbo.users where estado = 1 and alias = ?)
           ",[Session::get('alias'),Session::get('alias')],[Session::get('alias'),Session::get('alias')]
           );
  
  
          return response()->json($eventosCl);
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $evento = new Evento();

        $evento->setConnection('comanda');


        $evento->fecha_compromiso = $request['fechacompromiso'];
        $evento->fecha_creacion   = date('Ymd H:i');
        $evento->fecha_resolucion = $request['fecharesolucion'];
        $evento->descripcion      = $request['descripcion'];
        $evento->cliente          = $request['cliente'];
        $evento->num_suministro   = $request['suministro'];
        $evento->usuario_crm      = Session::get('usuario_crm');
        $evento->estado           = 1;

        $evento->save();

        $adjuntos       = $request['adjuntos']; //arreglo de adjuntos
        $descripciones  = $request['descripciones'];
        $tiposarchivos  = $request['tiposarchivos'];

        $queryrun = "";

        for($i=0; $i<=count($adjuntos)-1; $i++)
        {

            $adjunto = new CrmAdjuntos();
            $adjunto->fecha_creacion    = date('Ymd H:i');
            $adjunto->evento_id         = $evento->id;
            $adjunto->usuario_id        = Session::get('usuario_crm');
            $adjunto->adjunto           = $adjuntos[$i];
            $adjunto->descripcion       = $descripciones[$i];
            $adjunto->tipoarchivo       = $tiposarchivos[$i];


            //persistimos el objeto
            $queryrun = $adjunto->save();

        }


        return response()->json($queryrun);
    }


    //funcion para listar los adjuntos del evento seleccionado
    public function getAdjuntos(Request $request)
    {
        $adjuntos = DB::connection('comanda')->table('CRM_adjuntos as adjunto')
            ->leftjoin('CRM_atenciones as atencion','atencion.id','=','adjunto.atencion_id')
            ->leftjoin('CRM_tipos_archivos as tipos','tipos.id','=','adjunto.tipoarchivo')
            ->select('adjunto.*','tipos.nombre as tipo')
            ->where('adjunto.evento_id',$request['evento'])->orderBy('fecha_creacion')->get();


        return response()->json($adjuntos);
    }

    //guardar resolucion
    public function guardarResolucion(Request $request)
    {
        //creamos objeto de tipo evento
        $evento  = Evento::find($request['evento']);


        $evento->resolucion = $request['resolucion'];
        $evento->estado     = 2;

        //persistimos el objeto
        $queryrun = $evento->save();

        return response()->json($queryrun);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
