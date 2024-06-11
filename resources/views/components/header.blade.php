<header>
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 shadow-xl">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="{{ route('home') }}" class="flex items-center">
                <!-- Enlace a la ruta 'home' -->
                <span class="self-center text-xl font-semibold whitespace-nowrap text-black">Librería Nuevos Horizontes</span>
                <!-- Texto del logotipo de la librería -->
            </a>
            @livewire('book-search')
            <!-- Componente Livewire para buscar libros -->
            <div class="flex items-center lg:order-2 space-x-2">
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded"
                    onclick="window.location='{{ route('register') }}'">
                    <!-- Botón que redirige a la ruta de registro -->
                    Registrarme
                </button>
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded"
                    onclick="window.location='{{ route('login') }}'">
                    <!-- Botón que redirige a la ruta de inicio de sesión -->
                    Iniciar Sesión
                </button>
            </div>
        </div>
    </nav>
</header>
