@extends('layouts.new')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Préstamos</h1>

        <!-- Botón de Nuevo Préstamo -->
        <div class="mb-6">
            <a href="{{ route('loans.create') }}" class="px-4 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600">Nuevo Préstamo</a>
        </div>

        <!-- Lista de Préstamos -->
        <ul class="list-disc pl-5 space-y-2">
            @foreach($loans as $loan)
                <li class="flex justify-between items-center bg-gray-100 px-4 py-2 rounded-lg">
                    <span>
                        <a href="{{ route('loans.edit', $loan) }}" class="text-blue-500 hover:underline">{{ $loan->id }}</a>
                    </span>
                    <div class="flex space-x-2">
                        <form action="{{ route('loans.destroy', $loan) }}" method="POST" style="display:inline;">
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
