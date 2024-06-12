<?php

namespace App\Livewire;

use Livewire\Component; // Importar la clase Component de Livewire
use App\Models\Book; // Importar el modelo Book
use Illuminate\Support\Facades\DB; // Importar la clase DB

class BookSearch extends Component
{
    public $search = ''; // Propiedad para almacenar el texto de búsqueda
    public $books = []; // Propiedad para almacenar los libros encontrados

    // Método que se ejecuta cuando la propiedad $search cambia
    public function updatedSearch()
    {
        // Realizar una consulta utilizando SQL raw para buscar libros por título o autor que contengan la cadena de búsqueda
        $this->books = Book::where(function($query) {
                $query->where('title', 'LIKE', "%{$this->search}%")
                      ->orWhere('author', 'LIKE', "%{$this->search}%");
            })
            // Filtrar los libros que no están prestados o que han sido devueltos
            ->whereRaw('id NOT IN (SELECT DISTINCT book_id FROM loans WHERE returned = false)')
            ->get();
    }

    // Método que renderiza la vista correspondiente
    public function render()
    {
        return view('livewire.book-search');
    }
}