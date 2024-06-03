<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use Illuminate\Http\Request;

class ArchivoController extends Controller
{
    public function upload(Request $request)
    {
        /*El Request trae todo del formulario*/
        /*Recuperamos el id de la carpeta*/
        $id = $request->id;
        /*'file' viene del name del <input type="file" name="file" multiple />*/
        $file = $request->file('file');
        /*Se le asigna un nombre unico al archivo*/
        $fileName = time() . '-' . $file->getClientOriginalName();
        /*Metodo 1:
        Se crea la carpeta si no existe en C:\wamp64\www\sisgestiondearchivos\public\storage  //Cargar de forma pública */
        //$request->file('file')->storeAs($id, $fileName, 'public');
        /*Se crea la carpeta si no existe en C:\wamp64\www\sisgestiondearchivos\storage\app  //Cargar de forma privada */
        $request->file('file')->storeAs($id,$fileName);
        /*Metodo 2: Se crea la carpeta si no existe en C:\wamp64\www\sisgestiondearchivos\public */
        //$file->move(public_path($id),$fileName);

        $archivo = new Archivo();
        $archivo->carpeta_id = $request->id;
        $archivo->nombre=$fileName;
        $archivo->estado_archivo='PRIVADO';
        $archivo->save();
        //Redireccionamos según ruta definida en web.php. El Mensaje está definido en C:\wamp64\www\sisgestiondearchivos\resources\views\layouts\admin.blade.php
        return redirect()->back()
            ->with('titulo', 'Excelente!!')
            ->with('mensaje', 'Se cargó el Archivo Correctamente')
            ->with('icono', 'success');

    }
}
