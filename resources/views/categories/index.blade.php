@extends('layouts.app')

@php
$header = 'Categorias';
@endphp

@section('content')
    <!-- component -->
    <div class="bg-white pb-4 px-4 rounded-md w-full">
        <div class="flex justify-between w-full pt-6 ">
            <p class="ml-3">Categorias</p>
            <svg width="14" height="4" viewBox="0 0 14 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g opacity="0.4">
                    <circle cx="2.19796" cy="1.80139" r="1.38611" fill="#222222" />
                    <circle cx="11.9013" cy="1.80115" r="1.38611" fill="#222222" />
                    <circle cx="7.04991" cy="1.80115" r="1.38611" fill="#222222" />
                </g>
            </svg>

            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('categories.create') }}">Añadir categoria</a>
            </div>
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
                                <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">Activo</span>
                                |
                                <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">Inactivo</span>
                            </td>
                            <td class="px-4 py-4">{{ $category->user_id }}</td>
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

            <svg class="h-6 w-6" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g opacity="0.4">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M9 12C9 12.2652 9.10536 12.5196 9.29289 12.7071L13.2929 16.7072C13.6834 17.0977 14.3166 17.0977 14.7071 16.7072C15.0977 16.3167 15.0977 15.6835 14.7071 15.293L11.4142 12L14.7071 8.70712C15.0977 8.31659 15.0977 7.68343 14.7071 7.29289C14.3166 6.90237 13.6834 6.90237 13.2929 7.29289L9.29289 11.2929C9.10536 11.4804 9 11.7348 9 12Z"
                        fill="#2C2C2C" />
                </g>
            </svg>

            <p class="leading-relaxed cursor-pointer mx-2 text-blue-600 hover:text-blue-600 text-sm">1</p>
            <p class="leading-relaxed cursor-pointer mx-2 text-sm hover:text-blue-600">2</p>
            <p class="leading-relaxed cursor-pointer mx-2 text-sm hover:text-blue-600"> 3 </p>
            <p class="leading-relaxed cursor-pointer mx-2 text-sm hover:text-blue-600"> 4 </p>
            <svg class="h-6 w-6" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M15 12C15 11.7348 14.8946 11.4804 14.7071 11.2929L10.7071 7.2929C10.3166 6.9024 9.6834 6.9024 9.2929 7.2929C8.9024 7.6834 8.9024 8.3166 9.2929 8.7071L12.5858 12L9.2929 15.2929C8.9024 15.6834 8.9024 16.3166 9.2929 16.7071C9.6834 17.0976 10.3166 17.0976 10.7071 16.7071L14.7071 12.7071C14.8946 12.5196 15 12.2652 15 12Z"
                    fill="#18A0FB" />
            </svg>

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
    {!! $data->links() !!}
@endsection
