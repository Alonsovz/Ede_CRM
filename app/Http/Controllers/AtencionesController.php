<?php

namespace App\Http\Controllers;

use App\Atencion;
use App\CrmAdjuntos;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;

class AtencionesController extends Controller
{

    public function getConteoAtencion(){
        try{
            $atencionesC = DB::connection('comanda')->select("select count(id) as nocerrado from crm_atenciones
            where atencion_cerrada = 'N'
            and usuario_creacion =?
            ",[Session::get('alias')]);

            return response()->json($atencionesC);

        }catch(\Exception $e)
        {
            return response()->json($e->getMessage());
        }
    }

    //obtener todos los tipos de atenciones
    public function getTiposAtenciones()
    {
        //conexion con COMANDA
        $atenciones  = DB::connection('comanda')->table('CRM_tipo_atenciones')->orderBy('nombre','ASC')->get();

        return response()->json($atenciones);
    }


    //obtener todos los motivos de atenciones
    public function getMotivos()
    {
        //conexion con COMANDA
        $motivos = DB::connection('comanda')->table('CRM_motivo_atenciones')
        ->where('sistema','CRM')->orderBy('nombre','ASC')->get();

        return response()->json($motivos);
    }




    //Obtener las atenciones (RECLAMOS) del sistema de calidad y CRM
    public function atenciones()
    {
        try{
            $atenciones = DB::connection('calidad')->select("SELECT A.reclamo_cerrado as estado, A.correlativo as id, A.telefono, A.num_suministro,A.nombres_reporta+' '+A.apellidos_reporta as contacto,A.fecha as fecha_creacion,A.comentario as descripcion,t.descripcion_tipo_rreclamo as tipoatencion,
                                                            m.descripcion_mreclamo as motivoatencion,CAST(A.sistema AS NVARCHAR(10)) as sistema,
                                                            FC.NOMBRES+''+FC.APELLIDOS as cliente

                                                            FROM EDESAL_CALIDAD.dbo.fe_calidad_reclamos A
                                                            INNER JOIN fe_calidad_tipo_rreclamo t ON A.codigo_tipo_rreclamo = t.codigo_tipo_rreclamo
                                                            INNER JOIN fe_calidad_motivo_reclamo m ON A.codigo_mreclamo = m.codigo_mreclamo
                                                            INNER JOIN FACTURACION.dbo.FE_SUMINISTROS B ON A.num_suministro = B.num_suministro
                                                            INNER JOIN FACTURACION.dbo.FE_CLIENTE FC ON FC.CODIGO_CLIENTE = B.CODIGO_CLIENTE
                                                            WHERE B.usuario_unicom =?

                                                            UNION

                                                            SELECT c.atencion_cerrada as estado, 
                                                            CAST(c.id AS NUMERIC(8)) as id, 
                                                            CAST(c.telefono AS VARCHAR(8)) as telefono, 
                                                            c.num_suministro as num_suministro,c.contacto as contacto,
                                                            c.fecha_creacion as fecha_creacion,CAST(c.descripcion AS VARCHAR(1000)) as descripcion,
                                                            t.nombre as tipoatencion,m.nombre as motivoatencion,
                                                            CAST(c.sistema AS NVARCHAR(10)) as sistema,
                                                            c.cliente as cliente
                                                            FROM comanda_db.dbo.CRM_atenciones c
                                                            LEFT JOIN comanda_db.dbo.CRM_motivo_atenciones m ON m.id = c.id_motivo_atencion
                                                            LEFT JOIN comanda_db.dbo.CRM_tipo_atenciones t ON t.id = c.id_tipo_atencion
                                                            WHERE c.usuario_creacion =?
                                                            ",[Session::get('alias'),Session::get('alias')]);

            return response()->json($atenciones);

        }catch(\Exception $e)
        {
            return response()->json($e->getMessage());
        }



    }



    //Obtener las atenciones (RECLAMOS) del sistema de calidad y CRM
    public function atencionesMisClientes()
    {
        try{
            $atencionesCl = DB::connection('calidad')->select("SELECT c.atencion_cerrada as estado, 
            CAST(c.id AS NUMERIC(8)) as id, 
            CAST(c.telefono AS VARCHAR(8)) as telefono, 
            c.num_suministro as num_suministro,c.contacto as contacto,
            c.fecha_creacion as fecha_creacion,CAST(c.descripcion AS VARCHAR(1000)) as descripcion,
            t.nombre as tipoatencion,m.nombre as motivoatencion,
            CAST(c.sistema AS NVARCHAR(10)) as sistema,
             c.cliente as cliente, c.usuario_creacion as usuarioCreacion from comanda_db.dbo.crm_atenciones c
            LEFT JOIN comanda_db.dbo.crm_clientes cl on cl.empresa = c.cliente
            LEFT JOIN comanda_db.dbo.users u on u.id = cl.usuario_crm
            LEFT JOIN comanda_db.dbo.CRM_motivo_atenciones m ON m.id = c.id_motivo_atencion
            LEFT JOIN comanda_db.dbo.CRM_tipo_atenciones t ON t.id = c.id_tipo_atencion
            where u.alias =? and c.usuario_creacion != ? 
            ",[Session::get('alias'),Session::get('alias')],[Session::get('alias'),Session::get('alias')]);

            return response()->json($atencionesCl);

        }catch(\Exception $e)
        {
            return response()->json($e->getMessage());
        }



    }

    //ver adjuntos para una atencion seleccionada
    public function verAdjuntosByAtencion(Request $request)
    {
        $adjuntos = DB::connection('comanda')->table('CRM_adjuntos as adjunto')
            ->leftjoin('CRM_atenciones as atencion','atencion.id','=','adjunto.atencion_id')
            ->leftjoin('CRM_tipos_archivos as tipos','tipos.id','=','adjunto.tipoarchivo')
            ->select('adjunto.*','tipos.nombre as tipo')
            ->where('atencion.id',$request['atencion'])->orderBy('fecha_creacion')->get();


        return response()->json($adjuntos);
    }


    //listar los tipos de archivos
    public function listarTiposArchivos()
    {
        $tiposarchivos = DB::connection('comanda')->table('CRM_tipos_archivos')->orderBy('nombre','ASC')->get();

        return response()->json($tiposarchivos);
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

        try{

            $atencion = new Atencion();



            //iniciamos la transaccion
            //DB::beginTransaction();

            //rellenamos el objeto atencion
            $atencion->num_suministro       = $request['suministro'];
            $atencion->id_tipo_atencion     = $request['tipoatencion'];
            $atencion->id_motivo_atencion   = $request['motivoatencion'];
            $atencion->contacto             = $request['contacto'];
            $atencion->telefono             = $request['telefono'];
            $atencion->descripcion          = $request['descripcion'];
            $atencion->fecha_creacion       = date('Ymd H:i');
            $atencion->correo               = $request["correo"];
            $atencion->fax                  = $request["fax"];
            $atencion->whatsapp             = $request["whatsapp"];
            $atencion->sistema              = "CRM";
            $atencion->usuario_creacion     = Session::get('alias');
            $atencion->cliente              = $request['cliente'];
            $atencion->atencion_cerrada     = "N";




            //guardamos la consulta
            $queryrun = $atencion->save();

            //DB::commit();

            $adjuntos = $request['adjuntos']; //arreglo de adjuntos
            $descripciones = $request['descripciones'];
            $tiposarchivos = $request['tiposarchivos'];
            for($i=0; $i<=count($adjuntos)-1; $i++)
            {
                $adjunto = new CrmAdjuntos();
                $adjunto->fecha_creacion    = date('Ymd H:i');
                $adjunto->atencion_id       = $atencion->id;
                $adjunto->usuario_id        = Session::get('usuario_crm');
                $adjunto->adjunto           = $adjuntos[$i];
                $adjunto->descripcion       = $descripciones[$i];
                $adjunto->tipoarchivo       = $tiposarchivos[$i];
                //persistimos el objeto
                $queryrun = $adjunto->save();

            }


            return response()->json($queryrun);

        }catch(\Exception $e)
        {
            //DB::rollBack();
            $queryrun = $e->getMessage();
            return response()->json($queryrun);
        }


    }


    //guardar un archivo adjunto para las atenciones
    public function storeAdjunto(Request $request)
    {


        $file = $request->file('file');

        $nombreoriginal = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);

        $extension = '.PDF';

        $nombrenuevo = date('Ymd Hi').$nombreoriginal.$extension;

        $file->move('files/',(string)$nombrenuevo);

        return response()->json($nombrenuevo);
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
