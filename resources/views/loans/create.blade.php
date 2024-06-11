@extends('layouts.new')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Nuevo Préstamo</h1>
        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('loans.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="mb-3">
                <label for="book_id" class="block text-sm font-medium text-gray-700">ID del Libro</label>
                <input type="number" name="book_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
            </div>
            <div class="mb-3">
                <label for="user_id" class="block text-sm font-medium text-gray-700">ID del Usuario</label>
                <input type="number" name="user_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
            </div>
                <!-- DNI -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="dni" value="{{ __('DNI') }}" />
                <x-input id="dni" type="text" class="mt-1 block w-full" wire:model="state.dni" required autocomplete="dni" />
                <x-input-error for="dni" class="mt-2" />
            </div>
            <div class="mb-3">
                <label for="start_date" class="block text-sm font-medium text-gray-700">Fecha de Inicio</label>
                <input type="date" name="start_date" value="{{ $start_date }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
            </div>

            <div class="mb-3">
                <label for="due_date" class="block text-sm font-medium text-gray-700">Fecha de Devolución</label>
                <input type="date" name="due_date" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
            </div>
            @if($isAdmin)
                <div class="mb-3">
                    <label for="returned" class="block text-sm font-medium text-gray-700">Devuelto</label>
                    <select name="returned" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                        <option value="0">No</option>
                        <option value="1">Sí</option>
                    </select>
                </div>
            @endif
            <button type="submit" class="px-4 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600">Guardar</button>
        </form>
    </div>
</div>
@endsection

