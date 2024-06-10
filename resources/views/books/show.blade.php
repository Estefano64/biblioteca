@extends(Auth::check() ? 'layouts.new' : 'layouts.show')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">{{ $book->title }}</h1>
        <p><strong>Año:</strong> {{ $book->year }}</p>
        <p><strong>Autor:</strong> {{ $book->author }}</p>
        <p><strong>Editorial:</strong> {{ $book->publisher }}</p>
        <p><strong>Creado:</strong> {{ $book->created_at->format('d/m/Y') }}</p>
        <p><strong>Actualizado:</strong> {{ $book->updated_at->format('d/m/Y') }}</p>
        <div class="flex space-x-2">
            @guest <!-- Verifica si el usuario no está autenticado -->
                <a href="{{ route('login') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-red-600">Pedir Prestado</a>
            @else <!-- El usuario está autenticado -->
                <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-red-600">Pedir Prestado Login</a>
            @endguest
        </div>
    </div>
</div>
@endsection

