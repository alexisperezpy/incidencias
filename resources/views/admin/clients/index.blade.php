@extends('layouts.app')

@section('content')
    {{-- <div class="card mb-4">
        <div class="card-header bg-dark text-center">
            <h4 class="card-title text-white">Gestión de Clientes</h4>
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

            <form action="{{ route('userStore') }}" method="Post">
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
                    <button class="btn btn-success pull-right">Nuevo Cliente</button>    
                </div>
            </form>
        </div>
    </div> --}}

     <div class="card">
        @if (session('notification'))
            <div class="alert alert-success">
                {{session('notification')}}
            </div>
        @endif
        <div class="card-header bg-dark text-center">
            <h4 class="card-title text-white">Gestión de Clientes</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('client.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-dark pull-right">
                            Nuevo Cliente
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-6">
        <div class="card-header bg-dark text-center">
            <h4 class="card-title  text-white">Listado de Cientes</h4>
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
                                   <a href="{{route('client.edit',$user->id) }}" class="btn btn-md btn-warning" title="Editar">
                                        Editar
                                    </a>
                                </td>
                                <td width="10px" class="text-center">                               
                                     <a href="{{route('client.del',$user->id) }}" class="btn btn-md btn-danger" title="Borrar">
                                       Borrar
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class = "mt-4"> 
                    {{ $users->links() }} 
                </div>   
            </div>
        </div>
@endsection
