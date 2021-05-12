@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header bg-dark text-center">
            <h4 class="card-title text-white">Gestión de Proyectos</h4>
        </div>
        
        <div class="card-body">
            @if (session('notification'))
                <div class="alert alert-success">
                    {{session('notification')}}
                </div>
            @endif
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>    
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('project.store') }}" method="Post">
                @csrf
                <div class="form-group">
                    <label for="proyecto">Proyecto</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Ingrese el nombre del proyecto">
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" name="description" class="form-control" value="{{ old('description') }}" placeholder="Ingrese la descripcion"></input>
                </div>
               
                <div class="form-group">
                    <label for="fecha_inicio">Fecha de Inicio</label>
                    <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio', date('Y-m-d')) }}" placeholder="Ingrese la fecha de inicio del proyecto"></input>
                </div>
                
                <div class="form-group mb-2">
                    <button class="btn btn-success pull-right">Nuevo Proyecto</button>    
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-6">
        <div class="card-header bg-dark text-center">
            <h4 class="card-title  text-white">Listado de Proyectos</h4>
        </div>
            <div class="card-body">
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Fecha de Inicio</th>
                            <th colspan="2" class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project) 
                            <tr>       
                                <td>{{ $project->name }}</td>
                                <td>{{ $project->description }}</td>
                                <td>{{ $project->fecha_inicio ?: 'No se ha indicado' }}</td>
                                
                                @if ($project->trashed())
                                    <td colspan="2" class="text-center">                               
                                        <a href="{{route('project.restore',$project->id) }}" class="btn btn-md btn-success"">
                                        Restaurar
                                        </a>
                                    @else
                                        <td class="text-center">                               
                                            <a href="{{route('project.edit',$project->id) }}" class="btn btn-md btn-warning">
                                                Editar
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('project.del',$project->id) }}" class="btn btn-md btn-danger">
                                            Borrar
                                            </a>
                                        </td>
                                    @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class = "mt-4"> 
                    {{ $projects->links() }} 
                </div>  
            </div>
        </div>
@endsection
