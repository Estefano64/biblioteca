@extends('layouts.new')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Editar Préstamo</h1>
        <!-- Mostrar mensaje de error si existe -->
        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        <!-- Formulario para editar el préstamo -->
        <form action="{{ route('loans.update', $loan) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="book_title" class="block text-sm font-medium text-gray-700">Título del Libro</label>
                <input type="text" name="book_title" value="{{ $loan->book->title }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
            </div>
            <div class="mb-3">
                <label for="user_dni" class="block text-sm font-medium text-gray-700">DNI del Usuario</label>
                <input type="text" name="user_dni" value="{{ $loan->user->dni }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
            </div>
            <div class="mb-3">
                <label for="start_date" class="block text-sm font-medium text-gray-700">Fecha de Inicio</label>
                <input type="date" name="start_date" value="{{ $loan->start_date }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
            </div>
            <div class="mb-3">
                <label for="due_date" class="block text-sm font-medium text-gray-700">Fecha de Devolución</label>
                <input type="date" name="due_date" value="{{ $loan->due_date }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
            </div>
            <div class="mb-3">
                <label for="returned" class="block text-sm font-medium text-gray-700">Devuelto</label>
                <select name="returned" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                    <option value="0" @if ($loan->returned == 0) selected @endif>No</option>
                    <option value="1" @if ($loan->returned == 1) selected @endif>Sí</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600">Guardar</button>
        </form>
    </div>
</div>
@endsection



