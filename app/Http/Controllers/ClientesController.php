<?php

namespace App\Http\Controllers;

use App\ClientePotencial;
use App\ClienteUsuario;
use App\ContactoPotencial;
use App\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //conexion con factelec para listar los clientes
        $clientes = DB::connection('facturacion')->table('FE_CLIENTE as c')
                                    ->leftjoin('FE_SUMINISTROS as fs','c.CODIGO_CLIENTE','=','fs.CODIGO_CLIENTE')
                                    ->select(
                                        'c.CODIGO_CLIENTE as codigo',
                                        'c.NOMBRES as nombrecliente',
                                        'c.APELLIDOS as apellidocliente',
                                        'c.TELEFONO_UNO as telefono',
                                        'c.direccion',
                                        'c.DUI as dui',
                                        'c.NIT as nit'
                                    )->where('fs.usuario_unicom',Session::get('alias'))->distinct()->get();


        return response()->json($clientes);
    }

    //listar atenciones
    public function getallatencionesbyidClientes(Request $request)
    {
        $id = $request['cliente'];
        
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
            where c.cliente = '$id' ");

           

        return response()->json($atencionesCl);
    }
    


    //listar eventos
    public function geteventoseventosbyidClientes(Request $request)
    {
        $id = $request['cliente'];
        
        $eventosCl = DB::connection('calidad')->select("SELECT e.*,ee.nombre as estado, 
          (select alias from comanda_db.dbo.users where id = e.usuario_crm ) as usuario_creacion from 
          comanda_db.dbo.crm_eventos e
          inner join comanda_db.dbo.crm_clientes c on c.empresa = e.cliente
          inner join comanda_db.dbo.users u on u.id = c.usuario_crm
          inner join comanda_db.dbo.CRM_estados_eventos as ee on ee.id = e.estado
          where c.empresa = '$id' ");
  
  
          return response()->json($eventosCl);
    }



    //listar eventos
    public function geticketsbyidClientes(Request $request)
    {
        $id = $request['cliente'];
        
        $ticketsCl = DB::connection('calidad')->select("SELECT t.*,es.nombre as estado,
        (select nombre from comanda_db.dbo.users  where id = t.us_asignado) as nombreasignado,
         (select apellido from comanda_db.dbo.users  where id = t.us_asignado) as apellidoasignado,
                 (select alias from comanda_db.dbo.users where id = e.usuario_crm ) as usuario_creacion from 
                 comanda_db.dbo.tickets t
                 inner join comanda_db.dbo.crm_eventos e on e.id = t.evento_id
                 inner join comanda_db.dbo.estados  as es on es.id = t.estado_id
                 inner join comanda_db.dbo.crm_clientes c on c.empresa = e.cliente
                 inner join comanda_db.dbo.users u on u.id = c.usuario_crm
                 inner join comanda_db.dbo.CRM_estados_eventos as ee on ee.id = e.estado
         where c.empresa = '$id' ");
  
  
          return response()->json($ticketsCl);
    }
    




    //listar contactos
    public function listarContactosByCliente(Request $request)
    {
        //conexion con facturacion
        $contactos  = DB::connection('facturacion')->table('fe_cliente_contacto')->where('codigo_cliente',$request['f_cliente'])->get();

        return response()->json($contactos);
    }


    //listar los suministros por cliente
    public function listarSuministrosByCliente(Request $request)
    {
        //conexion con facturacion
        $suministros = DB::connection('facturacion')->table('FE_SUMINISTROS')->where('CODIGO_CLIENTE',$request['f_cliente'])->get();

        return response()->json($suministros);
    }


    //guardar un cliente potencial
    public function savePotencial(Request $request)
    {
        $cliente = new ClientePotencial();
        $cliente->setConnection('comanda');

        $cliente->empresa                   = $request['empresa'];
        $cliente->rubro                     = $request['rubro'];
        $cliente->direccion                 = $request['direccion'];
        $cliente->pbx                       = $request['pbx'];
        $cliente->tension_servicio          = $request['tension'];
        $cliente->fases                     = $request['fases'];
        $cliente->uso_servicio              = $request['servicio'];
        $cliente->tarifa                    = $request['tarifa'];
        $cliente->potencia                  = $request['potencia'];
        $cliente->sub_propiedad             = $request['subpropiedad'];
        $cliente->sub_ubicacion             = $request['sububicacion'];
        $cliente->sub_kva_instalados        = $request['kvainstalados'];
        $cliente->sub_transformadores       = $request['transformadores'];
        $cliente->sub_montaje               = $request['montaje'];
        $cliente->sub_conexion              = $request['conexion'];
        $cliente->sub_tipotransformador     = $request['transformador'];
        $cliente->sub_capacidadfusibles     = $request['fusiblesproteccion'];
        $cliente->turnos_produccion         = $request['turnosproduccion'];
        $cliente->conexion_num_cortes       = $request['numerocortes'];
        $cliente->fecha_visita              = $request['fechavisita'];
        $cliente->compromisos               = $request['compromisos'];
        $cliente->usuario_crm               = Session::get('usuario_crm');
        $cliente->hilos                     = $request['hilos'];
        $cliente->sub_kva_requeridos        = $request['kvareque'];
        $cliente->sub_transformadores_req   = $request['transformadoresreq'];
        $cliente->sub_ladoalta              = $request['voltajealta'];
        $cliente->sub_ladobaja              = $request['voltajebaja'];
        $cliente->porcentaje_costo_energia  = $request['costoporcentajeenergia'];
        $cliente->facturacion_mensual       = $request['facturacionmensual'];
        $cliente->margen_rentabilidad       = $request['margenrentabilidad'];
        $cliente->horas_produccion          = $request['horasproduccion'];
        $cliente->categoria                 = $request['categoria'];

        $queryrun = $cliente->save();



        return response()->json($cliente->id);


    }


    //funcion para obtener los clientes compartidos
    public function getCompartidos()
    {
        $clientes = DB::connection('comanda')->table('CRM_clientes as cli')
                            ->join('CRM_cliente_usuario as cliu','cliu.cliente','=','cli.id')
                            ->join('CRM_categoria_cliente as cc ','cc.id','=','cli.categoria')
                            ->select('cli.*','cc.nombre as categoria')
                            ->where('cliu.usuario',Session::get('usuario_crm'))
                            ->get();


        return response()->json($clientes);
    }

    //obtener los usuarios para un cliente
    public function getUsuariosByCliente(Request $request)
    {
        $usuarios = Db::connection('comanda')->table('CRM_cliente_usuario as cliente')
                                 ->leftjoin('users as usuario','usuario.id','=','cliente.usuario')
                                 ->select('usuario.nombre as nombre','usuario.apellido as apellido','usuario.id','cliente.id as linea')
                                 ->where('cliente.cliente',$request['cliente'])
                                 ->get();

        return response()->json($usuarios);
    }

    //dejar de compartir un cliente con un usuario
    public function dejarCompartirCliente(Request $request)
    {
        //linea a eliminar
        $lineaCliente = ClienteUsuario::find($request['linea']);

        //persistimos
        $queryrun = $lineaCliente->delete();

        return response()->json($queryrun);
    }


    //obtener clientes potenciales
    public function getClientesPotenciales()
    {
        $clientes = DB::connection('comanda')
            ->table('CRM_clientes as c')
            ->join('CRM_categoria_cliente as cc ','cc.id','=','c.categoria')
            ->select('c.*','cc.nombre as categoria')
            ->where('c.usuario_crm',Session::get('usuario_crm'))
            ->orderBy('empresa','asc')->get();

        return response()->json($clientes);
    }


    //obtener los contactos para un cliente seleccionado
    public function getContactosPotenciales(Request $request)
    {
        $contactos = DB::connection('comanda')->table('CRM_contactos_clientes')
                                            ->where('cli_potencial',$request['cliente'])
                                            ->orderBy('nombre','asc')
                                            ->get();

        return response()->json($contactos);
    }


    //guardar un contacto para un cliente potencial
    public function saveContactoByClientePotencial(Request $request)
    {
        $contacto = new ContactoPotencial();
        $contacto->setConnection('comanda');

        $contacto->nombre           = $request['nombre'];
        $contacto->cargo            = $request['cargo'];
        $contacto->teldirecto       = $request['telefono'];
        $contacto->celular          = $request['celular'];
        $contacto->correo           = $request['correo'];
        $contacto->usuario_crm      = Session::get('usuario_crm');
        $contacto->fecha_creacion   = date('Ymd H:i');
        $contacto->cli_potencial    = $request['cliente'];

        //persistimos el objeto contacto
        $queryrun = $contacto->save();

        return response()->json($queryrun);

    }


    //guardar usuarios para compartir un cliente
    public function saveUsuariosByCliente(Request $request)
    {

        $arreglo = $request['usuarios'];

        for($i=0; $i<=count($arreglo)-1;$i++)
        {

            $clienteusuario = new ClienteUsuario();

            $clienteusuario->setConnection('comanda');

            $ar = explode(' ',$arreglo[$i]);

            $usuario = DB::connection('comanda')->table('users')
            ->where('nombre',$ar[0])->where('apellido',$ar[1])->first();

            //llenamos el objeto
            $clienteusuario->cliente        = $request['cliente'];
            $clienteusuario->usuario        = $usuario->id;
            $clienteusuario->fecha_creacion = date('Ymd H:i');

            //persistimos el objeto
            $queryrun = $clienteusuario->save();

        }

        return response()->json($queryrun);


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
        //
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
