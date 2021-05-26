@extends('layouts.app')

@php
$header = 'Categorias';
@endphp

@section('content')
    <!-- component -->
    <div class="bg-white pb-4 px-4 rounded-md w-full">
        <div class="flex justify-end w-full pt-6 ">
            <a class="w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2"
                href="{{ route('categories.create') }}">Añadir categoria</a>
        </div>

        <div class="overflow-x-auto mt-6">

            <table class="table-auto border-collapse w-full">
                <thead>
                    <tr class="rounded-lg text-sm font-medium text-gray-700 text-left" style="font-size: 0.9674rem">
                        <th class="px-4 py-2 bg-gray-200 " style="background-color:#f8f8f8">NOMBRE</th>
                        <th class="px-4 py-2 " style="background-color:#f8f8f8">DESCRIPCION</th>
                        <th class="px-4 py-2 " style="background-color:#f8f8f8">FECHA CREACION</th>
                        <th class="px-4 py-2 " style="background-color:#f8f8f8">IMAGEN PORTADA</th>
                        <th class="px-4 py-2 " style="background-color:#f8f8f8">ESTATUS</th>
                        <th class="px-4 py-2 " style="background-color:#f8f8f8">CREADOR</th>
                        <th class="px-4 py-2 " style="background-color:#f8f8f8">ACCIONES</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-normal text-gray-700">
                    @foreach ($data as $key => $category)
                        <tr class="hover:bg-gray-100 border-b border-gray-200 py-10">
                            <td class="px-4 py-4">{{ $category->name }}</td>
                            <td class="px-4 py-4">{{ $category->description }}</td>
                            <td class="px-4 py-4">{{ $category->created_at }}</td>
                            <td class="px-4 py-4"><img
                                    class="w-auto h-14 rounded-sm border-gray-300 border transform hover:scale-125"
                                    src="/storage/image/{{ $category->image }}"></td>
                            <td class="px-4 py-4">
                                @if ($category->status === true)
                                    <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">Activo</span>
                                @else
                                    <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">Inactivo</span>
                                @endif
                            </td>
                            <td class="px-4 py-4">{{ $category->user_id }} | {{ $user->name }}</td>
                            <td class="px-4 py-4">
                                <div class="flex item-center justify-center">
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <a class="btn btn-info" href="{{ route('categories.show', $category->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <a class="btn btn-primary" href="{{ route('categories.edit', $category->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                            <a style="color:black" href="">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </a>
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="pagination" class="w-full flex justify-center border-t border-gray-100 pt-4 items-center">
            {!! $data->links() !!}
        </div>
    </div>

    <style>
        thead tr th:first-child {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        thead tr th:last-child {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        tbody tr td:first-child {
            border-top-left-radius: 5px;
            border-bottom-left-radius: 0px;
        }

        tbody tr td:last-child {
            border-top-right-radius: 5px;
            border-bottom-right-radius: 0px;
        }

    </style>
@endsection
