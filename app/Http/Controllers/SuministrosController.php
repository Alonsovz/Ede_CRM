<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Illuminate\Support\Facades\Session;

class SuministrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //conexion con facturacion
        $suministros = DB::connection('facturacion')
            ->table('FE_SUMINISTROS as fs')
            ->leftjoin('FE_CLIENTE as fc','fc.CODIGO_CLIENTE','=','fs.CODIGO_CLIENTE')
            ->select('fs.*','fc.NOMBRES as nombrecliente','fc.APELLIDOS as apellidocliente')
            ->where('usuario_unicom',Session::get('alias'))->get();

        return response()->json($suministros);
    }


    //obtener las atenciones realizadas a un suministro
    public function getAtencionesBySuministro(Request $request)
    {
        //conexion con calidad
        $atenciones = DB::connection('calidad')->table('fe_calidad_reclamos as r')
                                                ->leftjoin('fe_calidad_tipo_rreclamo as tr','tr.codigo_tipo_rreclamo','=','r.codigo_tipo_rreclamo')
                                                ->leftjoin('fe_calidad_motivo_reclamo as mr','mr.codigo_mreclamo','=','r.codigo_mreclamo')
                                                ->select('r.*','tr.descripcion_tipo_rreclamo as tiporeclamo','mr.descripcion_mreclamo as motivoreclamo')
                                                ->where('r.num_suministro',$request['suministro'])
                                                ->get();

        return response()->json($atenciones);
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
