@extends(Auth::check() ? 'layouts.new' : 'layouts.show')
<!-- Extiende el layout 'new' si el usuario está autenticado, de lo contrario, extiende el layout 'show' -->

@section('content')
<!-- Sección de contenido -->
<div class="container mx-auto p-4">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">{{ $book->title }}</h1>
        <!-- Título del libro -->
        <p><strong>Año:</strong> {{ $book->year }}</p>
        <!-- Año del libro -->
        <p><strong>Autor:</strong> {{ $book->author }}</p>
        <!-- Autor del libro -->
        <p><strong>Editorial:</strong> {{ $book->publisher }}</p>
        <!-- Editorial del libro -->
        <p><strong>Creado:</strong> {{ $book->created_at->format('d/m/Y') }}</p>
        <!-- Fecha de creación del libro -->
        <p><strong>Actualizado:</strong> {{ $book->updated_at->format('d/m/Y') }}</p>
        <!-- Fecha de actualización del libro -->
        <div class="flex space-x-2">
            @guest <!-- Verifica si el usuario no está autenticado -->
                <a href="{{ route('login') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-red-600">Pedir Prestado</a>
                <!-- Si no está autenticado, muestra un enlace para iniciar sesión -->
            @else <!-- El usuario está autenticado -->
                <a href="{{ route('loans.create') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-red-600">Pedir Prestado</a>
                <!-- Si está autenticado, muestra un enlace para pedir el libro prestado -->
            @endguest
        </div>
    </div>
</div>
@endsection
