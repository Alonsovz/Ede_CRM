<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;

class ReportesController extends Controller
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


   //listar atenciones
   public function getallatencionesbyidUsuarios(Request $request)
   {
       $id = $request['usuario'];
       
       $fecha1 = str_replace("-","",$request['fecha1']);
       $fecha2 = str_replace("-","",$request['fecha2']);
       
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
           where c.usuario_creacion = (select alias from comanda_db.dbo.users where id = '$id' )
           and c.fecha_creacion between '".$fecha1."'  and
         '".$fecha2."' 
           order by 2 desc ");

          

       return response()->json($atencionesCl);
   }


    //listar eventos
    public function getalleventosbyidUsuarios(Request $request)
    {
        $id = $request['usuario'];
        $fecha1 = str_replace("-","",$request['fecha1']);
        $fecha2 = str_replace("-","",$request['fecha2']);
        
        $eventosCl = DB::connection('calidad')->select("SELECT e.*,ee.nombre as estado, 
        (select alias from comanda_db.dbo.users where id = e.usuario_crm ) as usuario_creacion from 
        comanda_db.dbo.crm_eventos e
        inner join comanda_db.dbo.crm_clientes c on c.empresa = e.cliente
        inner join comanda_db.dbo.users u on u.id = c.usuario_crm
        inner join comanda_db.dbo.CRM_estados_eventos as ee on ee.id = e.estado
        where c.usuario_crm= '$id' and e.fecha_creacion between '".$fecha1."'  and
         '".$fecha2."' ");


        return response()->json($eventosCl);
    }
 

    

     //listar tickets
     public function getallticketsbyidUsuarios(Request $request)
     {
       
        
         $id = $request['usuario'];

         $fecha1 = str_replace("-","",$request['fecha1']);
         $fecha2 = str_replace("-","",$request['fecha2']);

         
         
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
         where t.creador_ticket = $id and t.fechasolicitud between '".$fecha1."'  and
         '".$fecha2."' ");
  
  
         return response()->json($ticketsCl);
     }




      //listar atenciones
   public function getallatencionesbyfechas(Request $request)
   {
 
       $fecha1 = str_replace("-","",$request['fecha1']);
       $fecha2 = str_replace("-","",$request['fecha2']);
       
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
           where c.fecha_creacion between '".$fecha1."'  and
         '".$fecha2."' 
           order by 2 desc ");

          

       return response()->json($atencionesCl);
   }


    //listar eventos
    public function getalleventosbyfechas(Request $request)
    {
     
        $fecha1 = str_replace("-","",$request['fecha1']);
        $fecha2 = str_replace("-","",$request['fecha2']);
        
        $eventosCl = DB::connection('calidad')->select("SELECT e.*,ee.nombre as estado, 
        (select alias from comanda_db.dbo.users where id = e.usuario_crm ) as usuario_creacion from 
        comanda_db.dbo.crm_eventos e
        inner join comanda_db.dbo.crm_clientes c on c.empresa = e.cliente
        inner join comanda_db.dbo.users u on u.id = c.usuario_crm
        inner join comanda_db.dbo.CRM_estados_eventos as ee on ee.id = e.estado
        where e.fecha_creacion between '".$fecha1."'  and
         '".$fecha2."' ");


        return response()->json($eventosCl);
    }
 

    

     //listar tickets
     public function getallticketsbyfechas(Request $request)
     {
       

         $fecha1 = str_replace("-","",$request['fecha1']);
         $fecha2 = str_replace("-","",$request['fecha2']);

         
         
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
         where  t.fechasolicitud between '".$fecha1."'  and
         '".$fecha2."' ");
  
  
         return response()->json($ticketsCl);
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
