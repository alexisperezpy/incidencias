@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header bg-dark text-center">
            <h4 class="card-title">Detalles de la Incidencia</h4>
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

                        @if($incident->state === 'Resuelto')
                            <td class="bg-success">{{ $incident->state }}</td>
                        @else
                            <td class="bg-warning">{{ $incident->state }}</td>
                        @endif
                        
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
                    <tr>
                        <th>Acción tomada</th>
                        <td>{{ $incident->accion }}</td>
                    </tr>
                    <tr>
                        <th>Fecha acción</th>
                        <td>{{ $incident->accion_date }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="pull-right">
                <a href="/home" class="btn btn-secondary btn-md">Volver</a>

                @if(auth()->user()->is_support && $incident->accion == null )
                    <a href="{{route('report.atender',$incident->id),'/atender' }}" class="btn btn-warning btn-md ">Atender</a> 
                @endif
                
                @if(auth()->user()->id == $incident->client_id && $incident->active != 0 && $incident->accion != null)
                    <a href="{{ route('report.cerrarIncidente',$incident->id) }}" class="btn btn-warning btn-md ">Marcar como Resuelto</a> 
                @endif
                
                @if(auth()->user()->id == $incident->support_id && $incident->active &&  $incident->accion == null )
                    <a href="#" class="btn btn-danger btn-md ">Derivar</a> 
                @endif
            </div>
        </div>
    </div>
@endsection