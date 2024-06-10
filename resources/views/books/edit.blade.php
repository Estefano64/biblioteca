@extends('layouts.new')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Editar Libro</h1>
        <form action="{{ route('books.update', $book) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                <input type="text" name="title" value="{{ $book->title }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
            </div>
            <div>
                <label for="year" class="block text-sm font-medium text-gray-700">Año</label>
                <input type="number" name="year" value="{{ $book->year }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
            </div>
            <div>
                <label for="author" class="block text-sm font-medium text-gray-700">Autor</label>
                <input type="text" name="author" value="{{ $book->author }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
            </div>
            <div>
                <label for="publisher" class="block text-sm font-medium text-gray-700">Editorial</label>
                <input type="text" name="publisher" value="{{ $book->publisher }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
            </div>
            <button type="submit" class="px-4 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600">Guardar</button>
        </form>
    </div>
</div>
@endsection

