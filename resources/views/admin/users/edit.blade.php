@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header bg-dark text-center">
            <h4 class="card-title text-white">Gestión de Usuarios</h4>
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

            <form action="{{ route('user.update',$user->id) }}" method="POST">
                @csrf

                <div class="form-group  mb-2">
                    <label for="email">email</label>
                    <input type="email" name="email" class="form-control" value="{{$user->email}}"></input>
                </div>

                <div class="form-group  mb-2">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $user->name }}"></input>
                </div>
                
                <div class="form-group mb-2">
                    <label for="clave">Contraseña</label>
                    <input type="password" name="clave" class="form-control"></input>
                </div>
                
                <div class="form-group mb-2">
                    <button class="btn btn-dark pull-right">Guardar Usuario</button>    
                </div>
            </form>
            <br>
        </div>
        <form method="POST" action="{{ route('projectUser.store') }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div class="row my-4 ">
                <div class="col-md-4 text-center mx-auto">              
                    <select name="project_id" class="form-control" id="select-project">
                        <option value="">Seleccione Proyecto</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mx-auto">
                    <select name="level_id" class="form-control" id="select-level">
                        <option value="">Seleccione nivel</option>
                    </select>
                </div>

                <div class="col-md-3 mx-auto">
                    <button type="submit" class="btn btn-primary btn-block">Asignar</button>
                </div>

            </div>

        </form>

        <div class="row my-1">
            <h4 class="mx-auto text-dark"><strong>Proyectos asignados</strong></h4>
               <div class="col-md-10 mx-auto">
                    @if (session('noti'))
                        <div class="alert alert-danger">
                            {{session('noti')}}
                        </div>
                    @endif
                </div>
                <div class="col-md-10 mx-auto">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>Proyecto</th>
                                <th>Nivel</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects_users as $project_user) 
                                <form method="get" action="{{ url('/proyecto-usuario/'.$project_user->id .'/eliminar') }}">
                                    @csrf
                                
                                <tr>       
                                    <td>{{ $project_user->project->name }}</td>
                                    <td>{{ $project_user->level->name }}</td>
                                    {{-- <td width="8px" class="text-center">                               
                                        <a href="{{route('project.edit',$project->id) }}" class="btn btn-md btn-warning" title="Editar">
                                            Editar
                                        </a> 
                                    </td> --}}
                                    <td width="8px" class="text-center">                               
                                        {{-- <a href="{{ route('projectUser.del', $project_user->id) }}" class="btn btn-md btn-danger" title="Borrar">
                                        Borrar
                                        </a> --}}
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </td>
                                </tr>
                                </form>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
    </div> <!-- Fin del Class CARD -->

@endsection

@section('scripts')
    <script src="/js/admin/users/edit.js"></script>
@endsection