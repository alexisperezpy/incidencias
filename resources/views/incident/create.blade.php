@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header bg-dark text-center">
            <h4 class="card-title">Reportar Incidencia</h4>
        </div>
        
        <div class="card-body">

            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>    
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('report.store') }}" method="Post">
                @csrf
                <div class="form-group">
                    <label for="caterogy_id">Categoría</label>
                    <select name="category_id" class="form-control">
                        <option value="0">General</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="severity">Severidad</label>
                    <select name="severity" class="form-control">
                        <option value="M">Menor</option>
                        <option value="N">Normal</option>
                        <option value="A">Alta</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">Titulo</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Ingrese el título">
                </div>

                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea name="description" class="form-control" placeholder="Ingrese la descripción">{{ old('description') }}</textarea>
                </div>
                
                <div class="form-group">
                    <button class="btn btn-success pull-right">Registrar Incidencia</button>    
                </div>
            </form>
        </div>
    </div>
@endsection