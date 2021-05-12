@extends('layouts.app')

@section('content')
    <div class="card mb-4">
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

            <form action="{{ route('user.store') }}" method="Post">
                @csrf
                
                <div class="form-group">
                    <label for="email">email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Ingrese el email">
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" placeholder="Ingrese su nombre"></input>
                </div>
               
                <div class="form-group">
                    <label for="clave">Contraseña</label>
                    <input type="text" name="clave" class="form-control" value="{{ old('clave','clave123456') }}" placeholder="Ingrese su contraseña"></input>
                </div>
                
                <div class="form-group mb-2">
                    <button class="btn btn-success pull-right">Nuevo Usuario</button>    
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-6">
        <div class="card-header bg-dark text-center">
            <h4 class="card-title  text-white">Listado de Usuarios</h4>
        </div>
            <div class="card-body">
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Nombre</th>
                            <th colspan="2" class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user) 
                            <tr>       
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->name }}</td>
                                <td width="10px" class="text-center">                               
                                    <a href="{{route('user.edit',$user->id) }}" class="btn btn-md btn-warning" title="Editar">
                                        Editar
                                    </a>
                                </td>
                                <td width="10px" class="text-center">                               
                                    <a href="{{route('user.del',$user->id) }}" class="btn btn-md btn-danger" title="Borrar">
                                       Borrar
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <div class = "mt-4"> 
                    {{ $users->links() }} 
                </div>    --}}
            </div>
        </div>
@endsection
