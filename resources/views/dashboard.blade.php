@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header bg-dark text-center">
            <h4> Sistema Gestión de Incidencias </h1>
        </div>

        
            <div class="card card-info mx-3 my-3">
                <div class="card-body">
                    <h4 class="card-title text-center">Incidencias asignadas a mí</h4>
                    <table class="table thead-dark table-sm table-bordered">
                         <thead>
                            <tr class="text-center">
                                <td>Código</td>
                                <td>Categoría</td>
                                <td>Severidad</td>
                                <td>Fecha creación</td>
                                <td>Estado</td>
                                <td>Resumen</td>
                            </tr>
                        </thead>
                        <tbody id="dashboard-my-incidents">
                            @foreach ($myIncidents as $incidentes)                             
                                <tr>
                                    @if($incidentes->severity == "A")
                                        <td class="table-danger text-center">{{ $incidentes->id }}</td>
                                        <td class="table-danger">{{ $incidentes->category->name }}</td>
                                        <td class="table-danger">{{ $incidentes->severity_full }} </td>
                                        <td class="table-danger">{{ $incidentes->created_at }}</td>
                                        <td class="table-danger">{{ $incidentes->deleted_at ?? 'Activo'}}</td>
                                        <td class="table-danger">{{ $incidentes->description_short }}</td>
                                    @else
                                        <td class="text-center">{{ $incidentes->id }}</td>
                                        <td>{{ $incidentes->category->name }}</td>
                                        <td>{{ $incidentes->severity_full }} </td>
                                        <td>{{ $incidentes->created_at }}</td>
                                        <td>{{ $incidentes->deleted_at ?? 'Activo'}}</td>
                                        <td>{{ $incidentes->description_short }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>   
            
            <div class="panel panel-success mx-3">
                <div class="card-body">
                    <h4 class="card-title text-center">Incidencias asignadas a otros</h4>
                    <table class="table table-sm table-bordered">
                         <thead class="thead-dark">
                            <tr>
                                <td>Código</td>
                                <td>Categoría</td>
                                <td>Severidad</td>
                                <td>Fecha creación</td>
                                <td>Resumen</td>
                                <td>Opción</td>
                            </tr>
                        </thead>
                        <tbody id="incidents-to-other">
                            @foreach ($pending_incidents as $pendientes)
                                <tr>
                                    <td>{{ $pendientes->id }}</td>
                                    <td>{{ $pendientes->category->name }}</td>
                                    <td>{{ $pendientes->severity_full }}</td>
                                    <td>{{ $pendientes->created_at }}</td>
                                    <td>{{ $pendientes->description_short }}</td>
                                    @if($pendientes->support_id == null)
                                        <td>
                                            <a href="" class="btn btn-primary btn-sm">Atender</a>
                                        </td>
                                    @else
                                        <td>
                                            <a href="" class="btn btn-primary btn-sm">Ver</a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>      

            <div class="card mx-3">
                <div class="card-body">
                    <h4 class="card-title text-center text-danger">Incidencias sin asingar</h4>
                    <table class="table table-sm table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <td>Código</td>
                                <td>Categoría</td>
                                <td>Severidad</td>
                                <td>Fecha creación</td>
                                <td>Estado</td>
                                <td>Resumen</td>
                            </tr>
                        </thead>
                        <tbody id="dashboard-incidents-not-asign">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
            </div>          
    </div>
@endsection
