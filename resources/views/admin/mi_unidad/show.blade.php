@extends('layouts.admin')
@section('content')
    <!--https://docs.dropzone.dev/getting-started/installation/stand-alone-->
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Carpeta: {{$carpeta->nombre}}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <!-- Button trigger modal -->
                <a href="{{url('admin/mi_unidad')}}" class="btn btn-default"><i class="bi bi-caret-left-fill"></i> Volver</a>

                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_cargar_archivos">
                    <i class="bi bi-cloud-arrow-up-fill"></i> Subir Archivos
                </button>

                <!-- Modal para Subir Archivos-->
                <div class="modal fade" id="modal_cargar_archivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cargar Archivos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{url('admin/mi_unidad/carpeta')}}" method="post" class="dropzone" id="myDropzone" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <input type="text" value="{{$carpeta->id}}" name="id" hidden>
                                    <div class="fallback">
                                        <input type="file" name="file" multiple/>
                                    </div>
                                </div>
                                <!-- <div class="modal-footer">
                                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                     <button type="submit" class="btn btn-primary">Subir Archivo</button>
                                 </div>-->
                            </form>
                        </div>
                    </div>
                </div>
                <script>
                    Dropzone.options.myDropzone = {
                        paramName: "file",
                        dictDefaultMessage: "Arrastra y suelta los archivos aquí o haz clic para seleccionar los archivos"
                    };
                </script>

                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                    <i class="bi bi-folder-fill"></i> Nueva Carpeta
                </button>

                <!-- Modal para crear Nueva Carpeta-->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nombre de la Carpeta</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{url('admin/mi_unidad/carpeta')}}" method="get">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{--se captura el id de la carpeta padre--}}
                                                <input type="text" value="{{$carpeta->id}}" name="carpeta_padre_id" hidden>
                                                {{--se captura el id del usuario autenticado--}}
                                                <input type="text" value="{{Auth::user()->id}}" name="user_id" hidden>
                                                <input type="text" class="form-control" name="nombre" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Crear</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>

        </ol>
    </div>
    </div>
    <hr>
    <h5>Carpetas y Archivos</h5>
    <hr>
    <div class="row">
        @foreach($subcarpetas as $subcarpeta)
            {{--visualiza el numero de carpetas que esten en la tabla carpetas de la BD--}}
            <div class="col-md-3">
                <div class="divcontent">
                    <div class="row" style="padding: 10px">
                        <div class="col-2" style="text-align: center">
                            <i class="far bi bi-folder-fill" style="font-size: 30px; color: {{$subcarpeta->color}}"></i>
                        </div>
                        <div class="col-8" style="margin-top: 5px">
                            <a href="{{url('admin/mi_unidad/carpeta/'.$subcarpeta->id)}}" style="color: black">
                                {{$subcarpeta->nombre}}
                            </a>
                        </div>
                        <div class="col-2" style="margin-top: 5px; text-align: right">
                            <div class="btn-group" role="group">
                                <button class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal_cambiar_nombre{{$subcarpeta->id}}"><i class="bi bi-pencil"></i> Cambiar Nombre
                                    </a>
                                    <a class="dropdown-item" href="#"><i class="bi bi-palette-fill"></i> Color Carpeta
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <form action="{{url('admin/mi_unidad/carpeta')}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" value="blue" name="color" hidden>
                                                <input type="text" value="{{$subcarpeta->id}}" name="id" hidden>
                                                <button style="background: white;border: 0px"><i class="bi bi-droplet-fill" style="color: blue"></i></button>
                                            </form>
                                            <form action="{{url('admin/mi_unidad/carpeta')}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" value="purple" name="color" hidden>
                                                <input type="text" value="{{$subcarpeta->id}}" name="id" hidden>
                                                <button style="background: white;border: 0px"><i class="bi bi-droplet-fill" style="color: purple"></i></button>
                                            </form>
                                            <form action="{{url('admin/mi_unidad/carpeta')}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" value="green" name="color" hidden>
                                                <input type="text" value="{{$subcarpeta->id}}" name="id" hidden>
                                                <button style="background: white;border: 0px"><i class="bi bi-droplet-fill" style="color: green"></i></button>
                                            </form>
                                            <form action="{{url('admin/mi_unidad/carpeta')}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" value="red" name="color" hidden>
                                                <input type="text" value="{{$subcarpeta->id}}" name="id" hidden>
                                                <button style="background: white;border: 0px"><i class="bi bi-droplet-fill" style="color: red"></i></button>
                                            </form>
                                            <form action="{{url('admin/mi_unidad/carpeta')}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" value="grey" name="color" hidden>
                                                <input type="text" value="{{$subcarpeta->id}}" name="id" hidden>
                                                <button style="background: white;border: 0px"><i class="bi bi-droplet-fill" style="color: grey"></i></button>
                                            </form>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="#"><i class="bi bi-trash"></i> Eliminar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal para cambiar el Nombre de la SubCarpeta-->
            <div class="modal fade" id="modal_cambiar_nombre{{$subcarpeta->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cambiar Nombre</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{url('admin/mi_unidad/carpeta')}}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="text" value="{{$subcarpeta->id}}" name="id" hidden>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" value="{{$subcarpeta->nombre}}" class="form-control" name="nombre" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <hr>
    <table class="table table-responsive table-hover table-striped">
        <thead>
        <tr>
            <th>
                <center>Nro</center>
            </th>
            <th>
                <center>Nombre</center>
            </th>
            <th>
                <center>Ultima Actualizacion</center>
            </th>
            <th>
                <center>Acciones</center>
            </th>
        </tr>
        </thead>
        <tbody>
        @php $contador=0; @endphp
        @foreach($archivos as $archivo)
            <tr>
                <td style="text-align: center">{{$contador=$contador+1}}</td>
                <td><?php $nombre = $archivo->nombre;
                        $extension = pathinfo($nombre, PATHINFO_EXTENSION);
                    if ($extension == "jpg" || $extension == "png") { ?> <img src="{{url('imagenes/iconos/jpg-png.png')}}" width="25px" alt="">
                    <?php }
                    if ($extension == "doc" || $extension == "docx") { ?> <img src="{{url('imagenes/iconos/doc.png')}}" width="25px" alt="">
                    <?php }
                    if ($extension == "xls" || $extension == "xlsx") { ?> <img src="{{url('imagenes/iconos/xls.png')}}" width="25px" alt="">
                    <?php }
                    if ($extension == "ppt" || $extension == "pptx") { ?> <img src="{{url('imagenes/iconos/ppt.png')}}" width="25px" alt="">
                    <?php }
                    if ($extension == "zip" || $extension == "rar") { ?> <img src="{{url('imagenes/iconos/rar.png')}}" width="25px" alt="">
                    <?php }
                    if ($extension == "mp4" || $extension == "avi" || $extension == "mkv" || $extension == "flv" || $extension == "mov" || $extension == "wmv" || $extension == "divx" || $extension
                        == "h.264" || $extension == "xvid" || $extension == "rm") { ?> <img src="{{url('imagenes/iconos/video.png')}}" width="25px" alt="">
                    <?php }
                    if ($extension == "wma" || $extension == "wmv" || $extension == "mp3" || $extension == "ogg" || $extension == "oga" || $extension == "mogg" || $extension == "aac" || $extension
                        == "m4a" || $extension == "3gp" || $extension == "m4r") { ?> <img src="{{url('imagenes/iconos/audio.png')}}" width="25px" alt="">
                    <?php }
                    if ($extension == "pdf") { ?> <img src="{{url('imagenes/iconos/pdf.png')}}" width="25px" alt="">
                    <?php }
                        ?>

                    <a href="" data-toggle="modal" data-target="#modal_visor{{$archivo->id}}" style="color: black">{{$archivo->nombre}}</a>

                    <!-- Condicion para jpg y png -->
                        <?php if ($extension == "jpg" || $extension == "png") { ?>
                        <!-- Modal Visor de jpg y png -->
                    <div class="modal fade" id="modal_visor{{$archivo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{$archivo->nombre}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="text-align: center">
                                    <img src="{{asset('storage/'.$carpeta->id.'/'.$archivo->nombre)}}" width="100%" alt="">
                                    <hr>
                                    <a href="{{asset('storage/'.$carpeta->id.'/'.$archivo->nombre)}}" class="btn btn-success">Ver en Navegador</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                        <!-- Condicion para pdf -->
                        <?php if ($extension == "pdf") { ?>
                        <!-- Modal Visor de jpg y png -->
                    <div class="modal fade" id="modal_visor{{$archivo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{$archivo->nombre}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="text-align: center">
                                    <iframe src="{{asset('storage/'.$carpeta->id.'/'.$archivo->nombre)}}" width="100%" height="550px" alt=""></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                        <!-- Condicion para doc y docx -->
                        <?php if ($extension == "doc" || $extension == "docx") { ?>
                        <!-- Modal Visor de jpg y png -->
                    <div class="modal fade" id="modal_visor{{$archivo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{$archivo->nombre}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="text-align: center">
                                    <img src="{{url('imagenes/iconos/doc.png')}}" width="50%" alt="">
                                    <hr>
                                    <a href="{{asset('storage/'.$carpeta->id.'/'.$archivo->nombre)}}" class="btn btn-success">Descargar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                        <!-- Condicion para xls y xlsx -->
                        <?php if ($extension == "xls" || $extension == "xlsx") { ?>
                        <!-- Modal Visor de jpg y png -->
                    <div class="modal fade" id="modal_visor{{$archivo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{$archivo->nombre}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="text-align: center">
                                    <img src="{{url('imagenes/iconos/xls.png')}}" width="50%" alt="">
                                    <hr>
                                    <a href="{{asset('storage/'.$carpeta->id.'/'.$archivo->nombre)}}" class="btn btn-success">Descargar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                        <!-- Condicion para zip y rar -->
                        <?php if ($extension == "zip" || $extension == "rar") { ?>
                        <!-- Modal Visor de jpg y png -->
                    <div class="modal fade" id="modal_visor{{$archivo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{$archivo->nombre}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="text-align: center">
                                    <img src="{{url('imagenes/iconos/rar.png')}}" width="50%" alt="">
                                    <hr>
                                    <a href="{{asset('storage/'.$carpeta->id.'/'.$archivo->nombre)}}" class="btn btn-success">Descargar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>


                        <!-- Condicion para audio -->
                        <?php if ($extension == "wma" || $extension == "wmv" || $extension == "mp3" || $extension == "ogg" || $extension == "oga" || $extension == "mogg" || $extension == "aac" || $extension
                        == "m4a" || $extension == "3gp" || $extension == "m4r") { ?>
                        <!-- Modal Visor de jpg y png -->
                    <div class="modal fade" id="modal_visor{{$archivo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{$archivo->nombre}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="text-align: center">
                                    <iframe src="{{asset('storage/'.$carpeta->id.'/'.$archivo->nombre)}}"  alt=""></iframe>
                                    <hr>
                                    <a href="{{asset('storage/'.$carpeta->id.'/'.$archivo->nombre)}}" class="btn btn-success">Ver en Navegador</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                        <!-- Condicion para video -->
                        <?php if ($extension == "mp4" || $extension == "avi" || $extension == "mkv" || $extension == "flv" || $extension == "mov" || $extension == "wmv" || $extension == "divx" || $extension
                        == "h.264" || $extension == "xvid" || $extension == "rm") { ?>
                        <!-- Modal Visor de jpg y png -->
                    <div class="modal fade" id="modal_visor{{$archivo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{$archivo->nombre}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="text-align: center">
                                    <iframe src="{{asset('storage/'.$carpeta->id.'/'.$archivo->nombre)}}" width="100%" height="550px" alt=""></iframe>
                                    <a href="{{asset('storage/'.$carpeta->id.'/'.$archivo->nombre)}}" class="btn btn-success">Ver en Navegador</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </td>
                <td>{{$archivo->updated_at}}</td>
                <td>Eliminar</td>

            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
