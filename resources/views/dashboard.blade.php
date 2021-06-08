@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header bg-dark text-center ">
            <h4 class="text-white"> Sistema Gestión de Incidencias </h1>
        </div>

        @if (auth()->user()->is_support || auth()->user()->is_admin)
            <div class="card card-info mx-3 my-3">
                <div class="card-body">
                    <h4 class="card-title text-center text-secondary">Incidencias asignadas a mí</h4>
                    <div class="table-responsive">
                        <table class="table ">
                            <thead class="table-dark">
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
                                @if(count($myIncidents) < 1)
                                    <tr>
                                        <td colspan="7" class="text-center">No existen Incidencias asingnadas</td>
                                    </tr>  
                                @else
                                    @foreach ($myIncidents as $incidentes)                             
                                        <tr>
                                            <td class="text-center">
                                                <a href="/ver/{{ $incidentes->id }}">{{ $incidentes->id }}</a>
                                            </td>
                                            <td>{{ $incidentes->category_name }}</td>

                                            @if($incidentes->severity == "A")
                                                <td class="bg-danger text-center">{{ $incidentes->severity_full }} </td>
                                            @else
                                                <td>{{ $incidentes->severity_full }} </td>
                                            @endif
                                                <td>{{ $incidentes->created_at }}</td>
                                                @if($incidentes->state === 'Resuelto')
                                                    <td class="bg-success">{{ $incidentes->state }}</td>
                                                @else
                                                    <td class="bg-warning">{{ $incidentes->state }}</td>
                                                @endif
                                                <td>{{ $incidentes->description_short }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>   
            
                <div class="panel panel-success mx-3">
                    <div class="card-body">
                        <h4 class="card-title text-center text-danger">Incidencias sin asignar</h4>
                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="table-dark">
                                    <tr>
                                        <td>Código</td>
                                        <td>Categoría</td>
                                        <td>Severidad</td>
                                        <td>Fecha creación</td>
                                        <td>Estado</td>
                                        <td>Resumen</td>
                                        <td>Opción</td>
                                    </tr>
                                </thead>
                                <tbody id="incidents-pending">
                                    @if(count($pending_incidents) < 1)
                                        <tr>
                                            <td colspan="7" class="text-center">No existen Incidencias</td>
                                        </tr>  
                                    @else
                                        @foreach ($pending_incidents as $pendientes)
                                            <tr class="text-center">
                                                <td>
                                                    <a href="/ver/{{ $pendientes->id }}">
                                                        {{ $pendientes->id }}
                                                    </a>
                                                </td>
                                                <td>{{ $pendientes->category_name }}</td>

                                                @if($pendientes->severity == "A")
                                                    <td class="bg-danger">{{ $pendientes->severity_full }}</td>
                                                @else
                                                    <td>{{ $pendientes->severity_full }}</td>
                                                @endif
                                                    <td>{{ $pendientes->created_at }}</td>
                                                @if($pendientes->state === 'Resuelto')
                                                    <td class="bg-success">{{ $pendientes->state }}</td>
                                                @else
                                                    <td class="bg-warning">{{ $pendientes->state }}</td>
                                                @endif
                                                <td>{{ $pendientes->description_short }}</td>
                                                @if($pendientes->support_id == null)
                                                    <td>
                                                        <a href="{{route('report.atender',$pendientes->id) }}" class="btn btn-primary btn-sm">Atender</a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <a href="/ver/{{ $pendientes->id }}" class="btn btn-primary btn-sm">Ver</a>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            
                            <div class = "mt-4"> 
                                {{ $pending_incidents->links() }} 
                            </div>
                        </div>
                    </div>
                </div>  
                
        @endif
            <div class="card mx-3">
                <div class="card-body">
                    <h4 class="card-title text-center text-success">Mis incidencias reportadas</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr class="text-center">
                                    <td>Código</td>
                                    <td>Categoría</td>
                                    <td>Severidad</td>
                                    <td>Fecha creación</td>
                                    <td>Estado</td>
                                    <td>Resumen</td>
                                    <td>Responsable</td>
                                </tr>
                            </thead>
                            <tbody id="dashboard-incidents-by-me">
                                @if(count($incidentsByMe) < 1)
                                    <tr>
                                        <td colspan="7" class="text-center">No existen Incidencias reportadas</td>
                                    </tr>  
                                                                    
                                @else
                                    @foreach ($incidentsByMe as $incident)
                                            <tr class="text-center">
                                                <td>
                                                    <a href="/ver/{{ $incident->id }}">
                                                        {{ $incident->id }}
                                                    </a>
                                                </td>
                                                <td>{{ $incident->category_name }}</td>

                                                @if($incident->severity == "A")
                                                    <td class="bg-danger">{{ $incident->severity_full }}</td>
                                                @else
                                                    <td>{{ $incident->severity_full }}</td>
                                                @endif
                                                <td>{{ $incident->created_at }}</td>
                                                @if($incident->state === 'Resuelto')
                                                    <td class="bg-success">{{ $incident->state }}</td>
                                                @else
                                                    <td class="bg-warning">{{ $incident->state }}</td>
                                                @endif
                                                <td>{{ $incident->description_short }}</td>
                                                <td>{{ $incident->support_name}}</td>
                                            </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>          
    </div>
@endsection
