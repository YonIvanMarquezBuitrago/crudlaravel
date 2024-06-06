@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Principal</h1>
    </div>
    <hr>
    <div class="row">

       @can('usuarios.index')
            {{--Widgets Usuarios--}}
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        @php $contador_de_usuarios=0; @endphp
                        @foreach($usuarios as $usuario)
                            @php $contador_de_usuarios++; @endphp
                        @endforeach
                        <h3>{{$contador_de_usuarios}}</h3>
                        <p>Usuarios Registrados</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <a href="{{url('admin/usuarios')}}" class="small-box-footer">
                        Más Información <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>{{--Fin Widgets Usuarios--}}

        {{--Widgets Carpetas--}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    @php $contador_de_carpetas=0; @endphp
                    @foreach($carpetas as $carpeta)
                        @php $contador_de_carpetas++; @endphp
                    @endforeach
                    <h3>{{$contador_de_carpetas}}</h3>
                    <p>Carpetas Registradas</p>
                </div>
                <div class="icon">
                    <i class="fas bi bi-folder-plus"></i>
                </div>
                <a href="{{url('admin/mi_unidad')}}" class="small-box-footer">
                    Más Información <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>{{--Fin Widgets Carpetas--}}

           {{--Widgets Archivos--}}
           <div class="col-lg-3 col-6">
               <div class="small-box bg-secondary">
                   <div class="inner">
                       @php $contador_de_archivos=0; @endphp
                       @foreach($archivos as $archivo)
                           @php $contador_de_archivos++; @endphp
                       @endforeach
                       <h3>{{$contador_de_archivos}}</h3>
                       <p>Archivos Registrados</p>
                   </div>
                   <div class="icon">
                       <i class="fas bi bi-file-earmark-plus-fill"></i>
                   </div>
                   <a href="{{url('admin/mi_unidad')}}" class="small-box-footer">
                       Más Información <i class="fas fa-arrow-circle-right"></i>
                   </a>
               </div>
           </div>{{--Fin Widgets Carpetas--}}
        @endcan
    </div>
@endsection
