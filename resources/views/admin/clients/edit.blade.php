@extends('layouts.app')

@section('content')
    <div class="card">
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

            <form action="{{ route('client.update',$user->id) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">email</label>
                    <input type="email" name="email" class="form-control" value="{{$user->email}}"></input>
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $user->name }}"></input>
                </div>
               
                <div class="form-group">
                    <label for="clave">Contraseña</label>
                    <input type="password" name="clave" class="form-control"></input>
                </div>
                
                <div class="form-group">
                    <button class="btn btn-dark pull-right">Actualizar Cliente</button>    
                </div>
            </form>
            <br>
        </div>
    </div>
@endsection