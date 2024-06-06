<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $request->file('file')->storeAs($id, $fileName);
        /*Metodo 2: Se crea la carpeta si no existe en C:\wamp64\www\sisgestiondearchivos\public */
        //$file->move(public_path($id),$fileName);

        $archivo = new Archivo();
        $archivo->carpeta_id = $request->id;
        $archivo->nombre = $fileName;
        $archivo->estado_archivo = 'PRIVADO';
        $archivo->save();
        //Redireccionamos según ruta definida en web.php. El Mensaje está definido en C:\wamp64\www\sisgestiondearchivos\resources\views\layouts\admin.blade.php
        return redirect()->back()
            ->with('titulo', 'Excelente!!')
            ->with('mensaje', 'Se cargó el Archivo Correctamente')
            ->with('icono', 'success');

    }

    public function eliminar_archivos(Request $request)
    {
        $id = $request->id;
        $archivo = Archivo::find($id);
        $estado_archivo = $archivo->estado_archivo;
        if ($estado_archivo == 'PRIVADO') {
            Storage::delete($archivo->carpeta_id . '/' . $archivo->nombre);
        } else {
            Storage::delete('public' . $archivo->carpeta_id . '/' . $archivo->nombre);
        }
        Archivo::destroy($id);
        //Redireccionamos según ruta definida en web.php. El Mensaje está definido en C:\wamp64\www\sisgestiondearchivos\resources\views\layouts\admin.blade.php
        return redirect()->back()
            ->with('titulo', 'Muy Bien!!')
            ->with('mensaje', 'Se eliminó el Archivo Correctamente')
            ->with('icono', 'success');
    }

    public function cambiar_de_privado_a_publico(Request $request)
    {
        $id = $request->id;//se extrae el id del archivo
        $estado_archivo = "PÚBLICO";//se estable el estado en una variable
        $archivo = Archivo::find($id);//se realiza la consulta y/o busqueda en la tabla de la BD
        $carpeta_id = $archivo->carpeta_id;//se extrae el id de la carpeta
        $nombre = $archivo->nombre;//se extrae el nombre del archivo

        $archivo->estado_archivo = $estado_archivo;//se cambia el estado en la tabla de la BD
        $archivo->save();

        $ruta_archivo_privado = $carpeta_id . '/' . $nombre;//se guarda ruta actual del archivo
        $ruta_archivo_publico = 'public/' . $carpeta_id . '/' . $nombre;// se guarda la ruta a la que se va amover el archivo

        Storage::move($ruta_archivo_privado,$ruta_archivo_publico);//se mueve el archivo

        return redirect()->back()
            ->with('titulo', 'Archivo Público!!')
            ->with('mensaje', 'Ahora el Archivo ha sido cambiado a Público')
            ->with('icono', 'success');
    }

    public function cambiar_de_publico_a_privado(Request $request)
    {
        $id = $request->id;//se extrae el id del archivo
        $estado_archivo = "PRIVADO";//se estable el estado en una variable
        $archivo = Archivo::find($id);//se realiza la consulta y/o busqueda en la tabla de la BD
        $carpeta_id = $archivo->carpeta_id;//se extrae el id de la carpeta
        $nombre = $archivo->nombre;//se extrae el nombre del archivo

        $archivo->estado_archivo = $estado_archivo;//se cambia el estado en la tabla de la BD
        $archivo->save();

        $ruta_archivo_privado = $carpeta_id . '/' . $nombre;//se guarda ruta actual del archivo
        $ruta_archivo_publico = 'public/' . $carpeta_id . '/' . $nombre;// se guarda la ruta a la que se va amover el archivo

        Storage::move($ruta_archivo_publico,$ruta_archivo_privado);//se mueve el archivo

        return redirect()->back()
            ->with('titulo', 'Archivo Privado!!')
            ->with('mensaje', 'Ahora el Archivo ha sido cambiado a Privado')
            ->with('icono', 'success');
    }
}
