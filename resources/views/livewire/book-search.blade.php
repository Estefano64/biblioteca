<!-- Contenedor principal para la búsqueda de libros -->
<div id="booksearch" class="relative">
    <!-- Formulario de búsqueda -->
    <form class="flex items-center">
        <div class="relative w-full">
            <!-- Contenedor del ícono de búsqueda -->
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <!-- Ícono de lupa para indicar búsqueda -->
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <!-- Campo de entrada para la búsqueda -->
            <input wire:model.live="search" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" type="search" placeholder="Buscar libros..." aria-label="Search">
        </div>
    </form>
    
    <!-- Resultados de búsqueda -->
    @if(!empty($books))
        <div class="absolute z-10 mt-2 w-full bg-white rounded-md shadow-lg">
            <!-- Iteración sobre la lista de libros encontrados -->
            @foreach($books as $book)
                <a href="{{ route('books.show', $book->id) }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                    <div class="flex items-center">
                        <div class="ml-3">
                            <!-- Título del libro -->
                            <h3 class="text-sm font-medium">{{ $book->title }}</h3>
                            <!-- Autor del libro -->
                            <p class="text-xs text-gray-500">{{ $book->author }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>
