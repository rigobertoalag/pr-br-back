@extends('layouts.app')

@php
    $header = 'Editar item'
@endphp

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Item</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('items.index') }}">Regresar</a>
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

<form action="{{ route('items.update',$item->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Item</strong>
                <input type="text" name="name" value="{{ $item->name }}" class="form-control" placeholder="Nombre del item">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                    <strong>Descripcion</strong>
                    <input type="text" name="description" value="{{ $item->description }}" class="form-control" placeholder="Descripcion del item">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Imagen:</strong>
                <p>Imagen actual</p>
                <img src="/storage/image/{{$item->img}}" alt="{{ $item->image }}" width="20%">
                <input type="file" name="image" value="{{ $item->image }}" id="{{ $item->image }}" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Categoria a la que pertenece</strong>
                
                <select class="form-control" name="category_id">
                    @foreach($cat as $key )
                    <option value="{{$key->id}}">
                        {{ $key->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
    </div>
</form>

@endsection