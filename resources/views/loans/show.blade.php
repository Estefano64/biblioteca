@extends('layouts.new')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Detalles del Préstamo</h1>
        <p><strong>ID:</strong> {{ $loans->id }}</p>
        <p><strong>Libro:</strong> {{ $loans->book_id }}</p>
        <p><strong>Usuario:</strong> {{ $loans->user_id }}</p>
        <p><strong>Fecha de inicio:</strong> {{ $loans->start_date }}</p>
        <p><strong>Fecha de devolución:</strong> {{ $loans->due_date }}</p>
        <p><strong>Devuelto:</strong> {{ $loans->returned ? 'Sí' : 'No' }}</p>
        <div class="flex space-x-2">
            <a href="{{ route('loans.edit', $loan) }}" class="px-4 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600">Editar</a>
            <form action="{{ route('loans.destroy', $loans) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Eliminar</button>
            </form>
        </div>
    </div>
</div>
@endsection

