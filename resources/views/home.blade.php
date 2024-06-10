@extends('layouts.show')

@section('content')
<div class="container mx-auto py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 sm:px-20 bg-white border-b border-gray-200">
            <h2 class="text-2xl mb-4">Lista de Libros:</h2>
            <ul>
                @foreach($books as $book)
                <li class="flex justify-between items-center bg-gray-100 px-4 py-2 rounded-lg mb-2">
                    <a href="{{ route('books.show', $book) }}" class="text-blue-500 hover:underline">
                        {{ $book->title }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection





