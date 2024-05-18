@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Listado de Usuarios</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Usuarios Registrados</h3>
                    <div class="card-tools">
                        <a href="{{url('admin/usuarios/create')}}" class="btn btn-primary"><i class="bi bi-person-fill-add"></i> Nuevo Usuario</a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-sm table-striped table-hover">
                        <thead>
                        <tr>
                            <th>
                                <center>Nro</center>
                            </th>
                            <th>
                                <center>Nombre</center>
                            </th>
                            <th>
                                <center>Email</center>
                            </th>
                            <th>
                                <center>Acciones</center>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $contador=0;
                        @endphp
                        @foreach($usuarios as $usuario)
                            @php
                                $contador=$contador+1;
                                $id=$usuario->id;
                            @endphp
                            <tr>
                                <td style="text-align: center">{{$contador}}</td>
                                <td>{{$usuario->name}}</td>
                                <td>{{$usuario->email}}</td>
                                <td style="text-align: center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        {{--Route::get('admin/usuarios/{id}', [\App\Http\Controllers\UsuarioController::class, 'show'])->name('usuarios.show')->middleware('auth');--}}
                                        <a href="{{route('usuarios.show',$usuario->id)}}" type="button" class="btn btn-info"><i class="bi bi-eye-fill"></i> Ver</a>
                                        <a href="{{route('usuarios.edit',$usuario->id)}}" type="button" class="btn btn-success"><i class="bi bi-pencil-square"></i> Editar</a>
                                        <form action="{{route('usuarios.destroy',$usuario->id)}}" onclick="preguntar<?=$id;?>(event)" method="post" id="miFormulario<?=$id;?>">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" style="border-radius: 0px 5px 5px 0px"><i class="bi bi-trash-fill"></i> Eliminar</button>
                                        </form>
                                        <script>
                                            function preguntar<?=$id;?>(event){
                                                event.preventDefault();
                                                Swal.fire({
                                                    title: "Eliminar Registro",
                                                    text: "¿Desea eliminar este registro?",
                                                    icon: "question",
                                                    showDenyButton: true,
                                                    confirmButtonText: "Eliminar",
                                                    confirmButtonColor: "#a5161d",
                                                    denyButtonColor: "#270a0a",
                                                    denyButtonText: "Cancelar",
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        var form=$('#miFormulario<?=$id;?>');
                                                        form.submit();
                                                        Swal.fire({
                                                            title: "Eliminado!",
                                                            text: "Tus archivos han sido eliminados.",
                                                            icon: "success"
                                                        });
                                                    }
                                                });
                                            }
                                        </script>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>

@endsection
