@extends('layouts.new')
<!-- Extiende el layout 'new' -->

@section('content')
<!-- Sección de contenido -->
<div class="container mx-auto p-4">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Nuevo Libro</h1>
        <!-- Formulario para crear un nuevo libro -->
        <form action="{{ route('books.store') }}" method="POST" class="space-y-4">
            @csrf
            <!-- Token CSRF para protección contra ataques -->

            <div class="mb-3">
                <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                <input type="text" name="title" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                <!-- Campo de entrada para el título del libro -->
            </div>

            <div class="mb-3">
                <label for="year" class="block text-sm font-medium text-gray-700">Año</label>
                <input type="number" name="year" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                <!-- Campo de entrada para el año del libro -->
            </div>

            <div class="mb-3">
                <label for="author" class="block text-sm font-medium text-gray-700">Autor</label>
                <input type="text" name="author" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                <!-- Campo de entrada para el autor del libro -->
            </div>

            <div class="mb-3">
                <label for="publisher" class="block text-sm font-medium text-gray-700">Editorial</label>
                <input type="text" name="publisher" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                <!-- Campo de entrada para la editorial del libro -->
            </div>

            <button type="submit" class="px-4 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600">Guardar</button>
            <!-- Botón para enviar el formulario -->
        </form>
    </div>
</div>
@endsection
