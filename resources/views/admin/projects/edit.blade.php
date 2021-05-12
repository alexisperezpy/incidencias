@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header bg-dark text-center">
            <h4 class="card-title text-white">Gestión de Proyectos</h4>
        </div>
        
        <class="card-body">

            <form action="{{ route('project.update',$project->id) }}" method="POST">
                @csrf

               <div class="form-group">
                    <label for="proyecto">Proyecto</label>
                    <input type="text" name="name" class="form-control" value="{{ $project->name }}" placeholder="Ingrese el nombre del proyecto">
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" name="description" class="form-control" value="{{ $project->description }}" placeholder="Ingrese la descripcion"></input>
                </div>
               
                <div class="form-group">
                    <label for="fecha_inicio">Fecha de Inicio</label>
                    <input type="date" name="fecha_inicio" class="form-control" value="{{ $project->fecha_inicio }}" ></input>
                </div>
                
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
                <div class="form-group">
                    <button class="btn btn-dark pull-right mb-4">Actualizar Proyecto</button>    
                </div>
            </form>
            <br>   
            <br>  
            
            
        <div class="row mt-4">
            <div class="col-sm-6 text-center">
                <h4>
                    <b>Gestión de Categorías</b>
                </h4>
                    <form class="form-inline mb-4" method="POST" action="{{ route('categoria.store') }}">
                        @csrf
                        <input class="form-control" type="hidden" name="project_id" value="{{ $project->id }}">
                        <div class="form-group mx-1">
                            <input class="form-control" type="text" name="name" placeholder="Ingrese el nombre de la Categoria">
                        </div> 
                        <div class="form-group ml-1">                           
                            <button type="submit" class="btn btn-info form-control">Añadir</button>
                        </div>
                    </form>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Categorías</th>
                                <th colspan="2" class="text-center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($categorias->isEmpty()) 
                                <tr><td colspan="3"><span>No se encontraron categorias asociadas al proyecto</span></tr></td>
                            @else 
                                @foreach ($categorias as $categoria) 
                                    <tr>       
                                        <td>{{ $categoria->id }}</td>
                                        <td>{{ $categoria->name }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-warning" data-category="{{ $categoria->id }}" title="editar">Editar</button>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('categoria.del',$categoria->id) }}" class="btn btn-sm btn-danger title="eliminar">Borrar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            
                        </tbody>
                    </table>
            </div>
        
            <div class="col-sm-6 text-center">
                <h4>
                    <b>Gestión de Niveles</b>
                </h4>
                <form class="form-inline mb-4" method="POST" action="{{ route('nivel.store') }}">
                     @csrf
                      <input class="form-control" type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="form-group mx-1">
                        <input class="form-control" type="text" name="name" placeholder="Ingrese el nombre del Nivel">
                    </div>  
                    <div class="form-group ml-1">
                    <button type="submit" class="btn btn-info form-control">Añadir</button>
                    </div>
                </form>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th class="text-center">Niveles</th>
                            <th colspan="2" class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @if($levels->isEmpty()) 
                            <tr><td colspan="3"><span>No se encontraron Niveles relacionados al proyecto</span></tr></td>
                        @else 
                            @foreach ($levels as $key => $level) 
                                <tr>       
                                    <td>N{{ $key+1 }}</td>
                                    <td>{{ $level->name }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-warning" data-level="{{ $level->id }}" title="editar">Editar</button>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('nivel.del',$level->id) }}" class="btn btn-sm btn-danger title="eliminar">Borrar</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div> 
        
        </div>
        </div>
    </div>
 
    {{-- Modal edit categoria --}}
    <div class="modal" tabindex="-1" role="dialog" id="modalEditCategoria">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Categoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" action="{{ route('categoria.update') }}"> 
                    @csrf               
                    <div class="modal-body">
                        <input type="hidden" name="categoria_id" id="categoria_id" value="">
                        <div class="form-group">
                            <label for="name">Nombre Categoria</label>
                            <input class="form-control" type="text" id="categoria_name" name="name" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal edit Niveles --}}
    <div class="modal" tabindex="-1" role="dialog" id="modalEditNivel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Nivel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" action="{{ route('nivel.update') }}">     
                    @csrf           
                    <div class="modal-body">
                        <input type="hidden" name="nivel_id" id="nivel_id" value="">
                        <div class="form-group">
                            <label for="name">Nombre Nivel</label>
                            <input class="form-control" type="text" id="nivel_name" name="name" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/js/admin/projects/edit.js"></script>
@endsection