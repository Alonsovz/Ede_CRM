<?php

namespace App\Http\Controllers;

use App\CRM_Ordenes;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Session;
use DB;
use Mail;

class TicketController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $ticket = new Ticket();
        $ticket->setConnection('comanda');

        $ticket->titulo         = $request['titulo'];
        $ticket->descripcion    = $request['descripcion'];
        $ticket->us_asignado    = $request['usuario'];
        $ticket->us_solicitante = Session::get('usuario_crm');
        $ticket->fechasolaprox  = $request['fecharesolucion'];
        $ticket->fechasolicitud = date('Ymd H:i');
        $ticket->creador_ticket = Session::get('usuario_crm');
        $ticket->categoria_id   = 8;
        $ticket->estado_id      = 2;
        $ticket->evento_id      = $request['evento'];
        $ticket->usuario_compartido = $request['usuarionotificar'];

        $queryrun = $ticket->save();

        $usuarioprincipal = User::find($request['usuario']);
        $usuarionotificar = User::find($request['usuarionotificar']);
        $usuariosolicitante = User::find(Session::get('usuario_crm'));


        Session::put('id',$ticket->id);
        Session::put('titulo',$ticket->titulo);
        Session::put('descripcion',$ticket->descripcion);
        Session::put('solicitante',$usuariosolicitante->nombre.' '.$usuariosolicitante->apellido);


        $ultimoticket = DB::connection('comanda')->table('tickets')->select('tickets.id')->orderBy('tickets.id','desc')->first();

        Mail::send('Correo.tickets.nuevoticket', ['usuarioprincipal' => $usuarioprincipal,'usuarionotificar'=>$usuarionotificar,'usuariosolicitante'=>$usuariosolicitante], function ($m) use ($usuarioprincipal,$usuarionotificar,$usuariosolicitante) {
            $m->from('comanda@edesal.com', $usuariosolicitante->nombre.' '.$usuariosolicitante->apellido);

            $m->to($usuarioprincipal->correo, '')->subject('Nuevo ticket');
        });

        Mail::send('Correo.tickets.nuevoticket', ['usuarioprincipal' => $usuarioprincipal,'usuarionotificar'=>$usuarionotificar,'usuariosolicitante'=>$usuariosolicitante], function ($m) use ($usuarioprincipal,$usuarionotificar,$usuariosolicitante) {
            $m->from('comanda@edesal.com', $usuariosolicitante->nombre.' '.$usuariosolicitante->apellido);

            $m->to($usuarionotificar->correo, '')->subject('Nuevo ticket');
        });


        return response()->json($ultimoticket->id);
    }



    //guardar ticket con orden de trabajo adjunta
    public function storeWithOrden(Request $request)
    {
        try{



            $ticket = new Ticket();
            $ticket->setConnection('comanda');



            $ticket->titulo         = $request['titulo'];
            $ticket->descripcion    = $request['descripcion'];
            $ticket->us_asignado    = $request['usuario'];
            $ticket->us_solicitante = Session::get('usuario_crm');
            $ticket->fechasolaprox  = $request['fecharesolucion'];
            $ticket->fechasolicitud = date('Ymd H:i');
            $ticket->creador_ticket = Session::get('usuario_crm');
            $ticket->categoria_id   = 8;
            $ticket->estado_id      = 2;
            $ticket->evento_id      = $request['evento'];
            $ticket->usuario_compartido = $request['usuarionotificar'];



            //guardamos la orden adjunta
            if( $ticket->save())
            {
                //creamos el objeto de tipo orden
                $orden = new CRM_Ordenes();

                $orden->setConnection('comanda');

                $orden->solicitud           = $request['trabajo'];
                $orden->fecha_solicitud     = date('Ymd H:i');
                $orden->fecha_resolucion    = $request['fecharesolucionorden'];
                $orden->direccion           = $request['direccionorden'];
                $orden->zona_agencia        = $request['agencia'];
                $orden->gerencia_solicita   = $request['gerencia'];
                $orden->contratista         = $request['contratista'];
                $orden->observaciones       = $request['observaciones'];
                $orden->solicitante         = Session::get('usuario_crm');
                $orden->asignado            = $ticket->us_asignado;
                $orden->evento              = $request['evento'];
                $orden->ticket_id           = $ticket->id;


                //persistimos
                $queryrun = $orden->save();



                $usuarioprincipal = User::find($request['usuario']);
                $usuarionotificar = User::find($request['usuarionotificar']);
                $usuariosolicitante = User::find(Session::get('usuario_crm'));


                Session::put('id',$ticket->id);
                Session::put('titulo',$ticket->titulo);
                Session::put('descripcion',$ticket->descripcion);
                Session::put('solicitante',$usuariosolicitante->nombre.' '.$usuariosolicitante->apellido);


                $ultimoticket = DB::connection('comanda')->table('tickets')->select('tickets.id')->orderBy('tickets.id','desc')->first();

                Mail::send('Correo.tickets.nuevoticket', ['usuarioprincipal' => $usuarioprincipal,'usuarionotificar'=>$usuarionotificar,'usuariosolicitante'=>$usuariosolicitante], function ($m) use ($usuarioprincipal,$usuarionotificar,$usuariosolicitante) {
                    $m->from('comanda@edesal.com', $usuariosolicitante->nombre.' '.$usuariosolicitante->apellido);

                    $m->to($usuarioprincipal->correo, '')->subject('Nuevo ticket');
                });

                Mail::send('Correo.tickets.nuevoticket', ['usuarioprincipal' => $usuarioprincipal,'usuarionotificar'=>$usuarionotificar,'usuariosolicitante'=>$usuariosolicitante], function ($m) use ($usuarioprincipal,$usuarionotificar,$usuariosolicitante) {
                    $m->from('comanda@edesal.com', $usuariosolicitante->nombre.' '.$usuariosolicitante->apellido);

                    $m->to($usuarionotificar->correo, '')->subject('Nuevo ticket');
                });


                return response()->json($queryrun);

            }


        }catch(\Exception $e)
        {


            return response($e);
        }



    }


    //aceptar solucion de ticket
    public function aceptarSolucion(Request $request)
    {
        $ticket = Ticket::find($request['ticket']);

        //actualizamos el estado
        $ticket->estado_id = 8;

        //persistimos el objeto
        $queryrun = $ticket->save();

        return response()->json($queryrun);
    }


    //denegar solucion de ticket
    public function denegarSolucion(Request $request)
    {
        $ticket = Ticket::find($request['ticket']);

        //actualizamos el estado
        $ticket->estado_id = 10;
        $ticket->comentariodenegado = $request['descripcion'];

        //persistimos el objeto
        $queryrun = $ticket->save();

        return response()->json($queryrun);
    }

    //guardar un ticket de tipo reminder
    public function guardarReminder(Request $request)
    {
        //creamos un objeto ticket
        $ticket = new Ticket();

        $ticket->descripcion    = $request['descripcion'];
        $ticket->fechasolaprox  = $request['fecha'];
        $ticket->categoria_id   = 10;
        $ticket->fechasolicitud = date('Ymd H:i');
        $ticket->us_solicitante = Session::get('usuario_crm');
        $ticket->us_asignado    = Session::get('usuario_crm');
        $ticket->estado_id      = 5;

        //persistimos el objeto
        $queryrun = $ticket->save();

        return response()->json($queryrun);
    }


    //obtener tickets por eventos
    public function getTicketsByEvento(Request $request)
    {
        $tickets = DB::connection('comanda')->table('tickets')
                                ->leftjoin('users as u','tickets.us_asignado','u.id')
                                ->leftjoin('estados as e','tickets.estado_id','e.id')
                                ->select('tickets.*','e.nombre as estado','u.nombre as nombreasignado','u.apellido as apellidoasignado')
                                ->where('evento_id',$request['evento'])->orderBy('fechasolicitud','desc')->get();

        return response()->json($tickets);
    }


    //obtener los reminders
    public function getReminders()
    {
        $reminders = DB::connection('comanda')->table('tickets')
            ->where('us_asignado',Session::get('usuario_crm'))
            ->where('estado_id','!=',8)
            ->where('categoria_id',1008)->get();

        return response()->json($reminders);
    }


    //finalizar reminder
    public function finalizarReminder(Request $request)
    {
        $reminder = Ticket::find($request['reminder']);

        //cambiamos estado
        $reminder->estado_id = 8;

        //persistimos el objeto
        $queryrun = $reminder->save();

        return response()->json($queryrun);
    }


    //obtener todos los tickets de tipo crm solicitados por un agente de ventas
    public function getTicketsAll()
    {
        $tickets = DB::connection('comanda')->table('tickets')
            ->leftjoin('users as u','tickets.us_asignado','u.id')
            ->leftjoin('estados as e','tickets.estado_id','e.id')
            ->select('tickets.*','e.nombre as estado','u.nombre as nombreasignado','u.apellido as apellidoasignado')
            ->where('tickets.categoria_id',8)
            ->where('tickets.us_solicitante',Session::get('usuario_crm'))
            ->orderBy('fechasolicitud','desc')
            ->get();

        return response()->json($tickets);
    }



    //obtener todos los tickets de tipo crm solicitados por un agente de ventas
    public function getTicketsAllOthers()
    {
         //conexion con COMANDA
         $ticketsCl = DB::connection('calidad')->select(" SELECT t.*,es.nombre as estado,
         (select nombre from comanda_db.dbo.users  where id = t.us_asignado) as nombreasignado,
          (select apellido from comanda_db.dbo.users  where id = t.us_asignado) as apellidoasignado,
                  (select alias from comanda_db.dbo.users where id = e.usuario_crm ) as usuario_creacion from 
                  comanda_db.dbo.tickets t
                  inner join comanda_db.dbo.crm_eventos e on e.id = t.evento_id
                  inner join comanda_db.dbo.estados  as es on es.id = t.estado_id
                  inner join comanda_db.dbo.crm_clientes c on c.empresa = e.cliente
                  inner join comanda_db.dbo.users u on u.id = c.usuario_crm
                  inner join comanda_db.dbo.CRM_estados_eventos as ee on ee.id = e.estado
          where t.categoria_id = 8 and u.alias = ? and e.usuario_crm != 
          (select id from comanda_db.dbo.users where estado = 1 and alias = ?)
          ",[Session::get('alias'),Session::get('alias')],[Session::get('alias'),Session::get('alias')]
          );

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
