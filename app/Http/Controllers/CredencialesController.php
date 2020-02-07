<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;

class CredencialesController extends Controller
{

    public function validacion(Request $request)
    {
        //conexion a comanda
        $usuario = DB::connection('comanda')
            ->table('users')
            ->where('correo',$request['usuario'])
           // ->where('password',$request['password'])
            ->first();

           // $passform = md5($request['password']);

            
            if ($usuario)
            {
                Session::put('alias',$usuario->alias);
                Session::put('usuario',$usuario->nombre.' '.$usuario->apellido);
                Session::put('usuario_crm',$usuario->id);

                $roles = DB::connection('comanda')->table('roles')
                ->join('usuario_rol as ur','roles.id','=','ur.rol_id')
                ->join('users as u','u.id','=','ur.user_id')
                ->select('roles.nombre as rol')
                ->where('u.id',$usuario->id)
                ->get();

                $arregloroles = $roles->toArray();

                Session::put('roles',$arregloroles);



            return response()->json("validado");

            }
            else
            {
                 return response()->json("no validado");
            }



        
    }


    //obtener usuarios del comanda
    public function getUsuariosComanda()
    {
        //conexion comanda
        $usuarios = DB::connection('comanda')->table('users')->orderBy('users.nombre','asc')->get();

        return response()->json($usuarios);
    }


    //funcion para cerrar sesion
    public function cerrarSesion()
    {
        //eliminamos todas las variables de sesion activas por el usuario
        Session::flush();

        return redirect('');
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
