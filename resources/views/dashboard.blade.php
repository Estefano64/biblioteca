<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Libreria Leyendo Horizontes

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="text-2xl">
                        Lista de Libros:
                        @foreach($books as $book)
                        <li class="flex justify-between items-center bg-gray-100 px-4 py-2 rounded-lg">
                            <span>
                                <a href="{{ route('books.show', $book) }}" class="text-blue-500 hover:underline">{{ $book->title }}</a>
                            </span>
                        </li>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
