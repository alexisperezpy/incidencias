@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header bg-dark text-center">
            <h4 class="card-title">Atención de la Incidencia</h4>
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
            
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Código</th=>
                        <th>Proyecto</th>
                        <th>Categoria</th>
                        <th>Fecha de envío</th>
                    </tr>
                </thead>
                <tbody>
                     <tr>
                        <td id="incident_key">{{ $incident->id }}</td>
                        <td id="incident_project">{{ $incident->project->name }}</td>
                        <td id="incident_category">{{ $incident->category_name }}</td>
                        <td id="incident_created_at">{{ $incident->created_at }}</td>
                    </tr>
                </tbody>
                <br>
                <thead class="table-dark">
                    <tr>
                        <th>Asignado a</th=>
                        <th>Visibilidad</th>
                        <th>Estado</th>
                        <th>Severidad</th>
                    </tr>
                </thead>
                <tbody>
                     <tr>
                        <td id="incident_resp">{{ $incident->support_name }}</td>
                        <td>Publico</td>
                        <td>{{ $incident->state }}</td>
                        <td>{{ $incident->severity_full }}</td>
                    </tr>
                </tbody>
                <br>
            </table>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Título</th>
                        <td>{{ $incident->title }}</td>
                    </tr>
                    <tr>
                        <th>Descripción extendida</th>
                        <td>{{ $incident->description }}</td>
                    </tr>
                </tbody>
            </table>

            <div>
                <form action="{{ route('report.updateAcciones',$incident->id) }}" method="Post">
                @csrf
                <div class="form-group">
                    <label for="accion">Acción Realizada</label>
                    <textarea name="accion" class="form-control" placeholder="Ingrese la acción">{{ old('accion') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="fecha_accion">Fecha Acción</label>
                    <input type="date" name="fecha_accion" class="form-control" value="{{ old('fecha_accion', date('Y-m-d')) }}" placeholder="Ingrese la fecha de la acción"></input>
                </div>
                <div class="form-group">
                    <button class="btn btn-success mx-2 float-right">Registrar Acción</button>    
                    <a href="{{ route('home') }}" class="btn btn-secondary ml-auto float-right">Cancelar</a>    
                </div>
            </form>
            </div>

        </div>
    </div>
@endsection