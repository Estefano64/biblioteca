@extends('layouts.new')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Libros</h1>

        <!-- Botón de Nuevo Libro -->
        <div class="mb-6">
            <a href="{{ route('books.create') }}" class="px-4 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600">Nuevo Libro</a>
        </div>

        <!-- Lista de Libros -->
        <ul class="list-disc pl-5 space-y-2">
            @foreach($books as $book)
                <li class="flex justify-between items-center bg-gray-100 px-4 py-2 rounded-lg">
                    <span>
                        <a href="{{ route('books.edit', $book) }}" class="text-blue-500 hover:underline">{{ $book->title }}</a>
                    </span>
                    <div class="flex space-x-2">
                        <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Eliminar</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection