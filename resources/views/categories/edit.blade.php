@extends('categories.layout')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar categoria</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('categories.index') }}">Regresar</a>
        </div>
    </div>
</div>

@if($errors->any())
<div class="alert alert-danger">
    <strong>Oops!</strong>Algo salio mal
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('categories.update',$category->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Categoria</strong>
                <input type="text" name="name" value="{{ $category->name }}" class="form-control" placeholder="Nombre de la categoria">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                    <strong>Descripcion</strong>
                    <input type="text" name="description" value="{{ $category->description }}" class="form-control" placeholder="Descripcion de la categoria">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Imagen:</strong>
                <p>Imagen actual</p>
                <img src="/storage/image/{{$category->image}}" alt="{{ $category->image }}" width="20%">
                <input type="file" name="image" id="" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
    </div>
</form>

@endsection