<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Carpeta;
use App\Models\Archivo;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Traer todos los Usuarios
        $usuarios=User::all();
        //Traer todas los Carpetas
        $carpetas=Carpeta::all();
        //Traer todas los Carpetas
        $archivos=Archivo::all();
        /*se envia la variable a la vista*/
        //return view('admin.index',['usuarios'=>$usuarios]);
        return view('admin.index',compact('usuarios','carpetas','archivos'));
    }

}
