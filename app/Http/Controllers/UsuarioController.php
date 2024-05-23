<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //a la variable se le asigna todo el contenido de datos de la tabla user, es una consulta
        $usuarios = User::all();
        //A traves de la vista se hace la consulta
        return view('admin.usuarios.index', ['usuarios' => $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Recuperar todo lo que está dentro del formulario
        // $datos=request()->all();
        //return response()->json($datos);

        //Validación backend: name de los input en el formulario
        $request->validate([
            'name' => 'required|max:100',
            //este campo debe ser requerido y unico en la tabla users
            'email' => 'required|unique:users',
            //este campo debe ser requwerido y confirmado
            'password' => 'required|confirmed',
        ]);
        //se declara la variable y se hace instanciación al Modelo
        $usuario=new User();
        $usuario->name=$request->name;
        $usuario->email=$request->email;
        //Definimos el tipo de encriptado para el password
        $usuario->password=Hash::make($request['password']);
        //Guardamos los datos en la tabla de la BD
        $usuario->save();
        //Redireccionamos segun ruta definida en web.php
        return redirect()->route('usuarios.index')->with('titulo','Excelente!!')->with('mensaje','Se registró al Usuario Correctamente')->with('icono','success');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //echo $id;
        //En singular se hace la busqueda en el Modelo (consulta), con find($id) encuentra los id, pero si el id no existe arroja error, por ello se usa mejor findOrFail($id)
        $usuario=User::findOrFail($id);
        //Se envia la variable a la vista
        return view('admin.usuarios.show',['usuario'=>$usuario]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //La función edit retorna los datos
        //echo $id;
        //En singular se hace la busqueda en el Modelo (consulta), con find($id) encuentra los id, pero si el id no existe arroja error, por ello se usa mejor findOrFail($id)
        $usuario=User::findOrFail($id);
        //Se envia la variable a la vista
        return view('admin.usuarios.edit',['usuario'=>$usuario]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //La función update ejecuta las modificaciones que se hagan
        //Validación backend: name de los input en el formulario
        $request->validate([
            'name' => 'required|max:100',
            //este campo debe ser requerido y unico en la tabla users
            //'email' => 'required|unique:users',
            //este campo debe ser requwerido y confirmado
            //'password' => 'required|confirmed',
        ]);
        $usuario=User::find($id);
        $usuario->name=$request->name;
        $usuario->email=$request->email;
        //Definimos el tipo de encriptado para el password
        $usuario->password=Hash::make($request['password']);
        //Guardamos los datos en la tabla de la BD
        $usuario->save();
        //Redireccionamos segun ruta definida en web.php
        return redirect()->route('usuarios.index')->with('titulo','Buen Trabajo!!')->with('mensaje','Se actualizó el Usuario Correctamente')->with('icono','info');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('usuarios.index');
    }
}
