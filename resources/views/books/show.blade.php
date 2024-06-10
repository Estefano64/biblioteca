@extends('layouts.new')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">{{ $book->title }}</h1>
        <p><strong>Año:</strong> {{ $book->year }}</p>
        <p><strong>Autor:</strong> {{ $book->author }}</p>
        <p><strong>Editorial:</strong> {{ $book->publisher }}</p>
        <p><strong>Creado:</strong> {{ $book->created_at->format('d/m/Y') }}</p>
        <p><strong>Actualizado:</strong> {{ $book->updated_at->format('d/m/Y') }}</p>

    </div>
</div>
@endsection
