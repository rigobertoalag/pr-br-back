@extends('categories.layout')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            CMS
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('categories.create' )}}">Añadir categoria</a>
        </div>
    </div>
</div>

@if($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripcion</th>
    </tr>

    @foreach($data as $key => $value)
    <tr>
        <td>{{ $value->id }}</td>
        <td>{{ $value->name }}</td>
        <td>{{ \Str::limit($value->description, 100) }}</td>
        <td>
            <form action="{{ route('categories.destroy', $value->id) }}" method="POST">
                <a class="btn btn-info" href="{{ route('categories.show', $value->id)  }}">Detalles</a>
                <a class="btn btn-primary" href="{{ route('categories.edit', $value->id)  }}">Editar</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $data->links() !!}

@endsection