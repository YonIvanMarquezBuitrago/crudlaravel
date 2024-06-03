<?php

namespace App\Http\Controllers;

use App\Models\Carpeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarpetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Se autentica para que solo muestre las carpetas y archivos del usuario correspondiente
        $id_user=Auth::user()->id;
        /*Se condiciona la busqueda a aque solo traiga las carpetas padre*/
        /*$carpetas = Carpeta::all();*/
        $carpetas = Carpeta::whereNull('carpeta_padre_id')
            ->where('user_id',$id_user)
            ->get();
        return view('admin.mi_unidad.index', ['carpetas' => $carpetas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //No se utiliza esta función ya que para eso usamos el modal en C:\wamp64\www\sisgestiondearchivos\resources\views\admin\mi_unidad\index.blade.php
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
            'nombre' => 'required|max:191',
        ]);
        //se declara la variable y se hace instanciación al Modelo
        $carpeta = new Carpeta();
        $carpeta->nombre = $request->nombre;
        $carpeta->user_id = $request->user_id;
        //Guardamos los datos en la tabla de la BD
        $carpeta->save();
        //Redireccionamos según ruta definida en web.php. El Mensaje está definido en C:\wamp64\www\sisgestiondearchivos\resources\views\layouts\admin.blade.php
        return redirect()->route('mi_unidad.index')->with('titulo', 'Excelente!!')->with('mensaje', 'Se registró la Carpeta Correctamente')->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $carpeta = Carpeta::findOrFail($id);
        /*Mostrar subcarpetas de cauerdo a la relacion de C:\wamp64\www\sisgestiondearchivos\app\Models\Carpeta.php*/
        $subcarpetas = $carpeta->carpetasHijas;
        /*Mostrar Archivos*/
        $archivos = $carpeta->archivos;
        return view('admin.mi_unidad.show', compact('carpeta', 'subcarpetas', 'archivos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //Recuperar todo lo que está dentro del formulario
        //$datos=request()->all();
        //return response()->json($datos);

        //Validación backend: name de los input en el formulario
        $request->validate([
            'nombre' => 'required|max:191',
        ]);

        $id = $request->id;
        //se declara la variable y se hace instanciación al Modelo
        $carpeta = Carpeta::find($id);
        $carpeta->nombre = $request->nombre;
        //Guardamos los datos en la tabla de la BD
        $carpeta->save();
        //Redireccionamos según ruta definida en web.php. El Mensaje está definido en C:\wamp64\www\sisgestiondearchivos\resources\views\layouts\admin.blade.php
        return redirect()->route('mi_unidad.index')
            ->with('titulo', 'Excelente!!')
            ->with('mensaje', 'Se Actualizó la Carpeta Correctamente')
            ->with('icono', 'success');
    }

    public function update_color(Request $request)
    {
        $id = $request->id;
        //se declara la variable y se hace instanciación al Modelo
        $carpeta = Carpeta::find($id);
        $carpeta->color = $request->color;
        //Guardamos los datos en la tabla de la BD
        $carpeta->save();
        //Redireccionamos según ruta definida en web.php. El Mensaje está definido en C:\wamp64\www\sisgestiondearchivos\resources\views\layouts\admin.blade.php
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function crear_subcarpeta(Request $request)
    {
        //Recuperar todo lo que está dentro del formulario
        // $datos=request()->all();
        //return response()->json($datos);

        //Validación backend: name de los input en el formulario
        $request->validate([
            'nombre' => 'required|max:191',
            'carpeta_padre_id' => 'required',
        ]);
        //se declara la variable y se hace instanciación al Modelo
        $carpeta = new Carpeta();
        $carpeta->nombre = $request->nombre;
        $carpeta->user_id = $request->user_id;
        $carpeta->carpeta_padre_id = $request->carpeta_padre_id;
        //Guardamos los datos en la tabla de la BD
        $carpeta->save();
        //Redireccionamos según ruta definida en web.php. El Mensaje está definido en C:\wamp64\www\sisgestiondearchivos\resources\views\layouts\admin.blade.php
        return redirect()->back()->with('titulo', 'Excelente!!')->with('mensaje', 'Se registró la Carpeta Correctamente')->with('icono', 'success');
    }

    public function update_subcarpeta(Request $request)
    {
        //Validación backend: name de los input en el formulario
        $request->validate([
            'nombre' => 'required|max:191',
        ]);
        //se declara la variable y se hace instanciación al Modelo
        $id = $request->id;
        $carpeta = Carpeta::find($id);
        $carpeta->nombre = $request->nombre;
        //Guardamos los datos en la tabla de la BD
        $carpeta->save();
        //Redireccionamos según ruta definida en web.php. El Mensaje está definido en C:\wamp64\www\sisgestiondearchivos\resources\views\layouts\admin.blade.php
        return redirect()->back()->with('titulo', 'Excelente!!')->with('mensaje', 'Se actualizó la Carpeta Correctamente')->with('icono', 'success');
    }

    public function update_subcarpeta_color(Request $request)
    {
        $id = $request->id;
        //se declara la variable y se hace instanciación al Modelo
        $carpeta = Carpeta::find($id);
        $carpeta->color = $request->color;
        //Guardamos los datos en la tabla de la BD
        $carpeta->save();
        //Redireccionamos según ruta definida en web.php. El Mensaje está definido en C:\wamp64\www\sisgestiondearchivos\resources\views\layouts\admin.blade.php
        return redirect()->back();
    }
}
