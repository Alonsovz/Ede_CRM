<?php

namespace App\Http\Controllers;

use App\CRM_Ordenes;
use App\Ticket;
use Illuminate\Http\Request;
use DB;
use Session;

class EdesalServiceController extends Controller
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

    //obtener las ordenes
    public function getOrdenes()
    {
        $ordenes = DB::connection('comanda')
            ->table('CRM_ordenes_trabajo as orden')
            ->leftjoin('users as u','u.id','=','orden.solicitante')
            ->select('orden.*','u.nombre as nombresolicitante','u.apellido as apellidosolicitante')
            ->orderBy('fecha_solicitud','ASC')
            ->get();

        return response()->json($ordenes);
    }


    //aprobar la orden por parte de ventas
    public function aprobarOrdenVenta(Request $request)
    {
        $orden = CRM_Ordenes::find($request['orden']);

        //actualizamos el estado
        $orden->autorizado_2 =  1;
        $orden->comentarioaprob_ventas = $request['comentario'];

        //persistimos
        $queryrun = $orden->save();
    }


    //denegar una orden de ventas
    public function denegarOrdenVenta(Request $request)
    {
        $orden = CRM_Ordenes::find($request['orden']);

        $orden->autorizado_2 = 0;
        $orden->comentariodenegacion = $request['comentario'];


        //ticket
        $ticket = Ticket::find($orden->ticket_id);

        //actualizamos el estado
        $ticket->estado_id = 8;

        //persistimos
        $ticket->save();

        $queryrun = $orden->save();

        return response()->json($queryrun);
    }


    //funcion para obtener ordenes para el usuario asignado
    public function getOrdenesForAsignado(Request $request)
    {
        $ordenes = DB::connection('comanda')
            ->table('CRM_ordenes_trabajo as orden')
            ->leftjoin('users as u','u.id','=','orden.solicitante')
            ->select('orden.*','u.nombre as nombresolicitante','u.apellido as apellidosolicitante')
            ->orderBy('fecha_solicitud','ASC')
            ->where('orden.asignado',Session::get('usuario_crm'))
            ->get();

        return response()->json($ordenes);
    }


    //aprobar ordenes de trabajo
    public function aprobarOrden(Request $request)
    {
        $orden = CRM_Ordenes::find($request['orden']);

        $orden->setConnection('comanda');

        //actualizamos la columa de la orden donde esta la autorizacion de gerencia tecnica
        $orden->autorizado_1 = 1;
        $orden->comentarioaprob_admin = $request['comentario'];

        //persistimos el objeto
        $queryrun = $orden->save();

        return response()->json($queryrun);
    }


    //imprimir orden
    public function imprimirOrden(Request $request)
    {
        $orden = DB::connection('comanda')
            ->table('CRM_ordenes_trabajo as orden')
            ->leftjoin('users as u','u.id','=','orden.solicitante')
            ->leftjoin('CRM_eventos as e','e.id','=','orden.evento')
            ->select('u.nombre as solicitantenombre','u.apellido as solicitanteapellido','orden.*','e.cliente as cliente')
            ->where('orden.id',$request['orden'])
            ->first();

        $view =  \View::make('reportes.EdesalService.ordentrabajo', compact('orden'))->render();

        $pdf = \App::make('dompdf.wrapper');

        $pdf->loadHTML($view);

        //return response()->json($iva);

        return $pdf->stream('hojacontrol.pdf');
    }


    //denegar orden
    public function denegarOrden(Request $request)
    {
        $orden = CRM_Ordenes::find($request['orden']);

        $orden->autorizado_1 = 0;
        $orden->comentariodenegacion = $request['comentario'];


        //ticket
        $ticket = Ticket::find($orden->ticket_id);

        //actualizamos el estado
        $ticket->estado_id = 8;

        //persistimos
        $ticket->save();

        $queryrun = $orden->save();

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
