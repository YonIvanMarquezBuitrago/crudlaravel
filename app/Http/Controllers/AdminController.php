<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        /*se envia la variable a la vista*/
        return view('admin.index',['usuarios'=>$usuarios]);
    }

}
