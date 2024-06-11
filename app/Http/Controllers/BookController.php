<?php

namespace App\Http\Controllers;

use App\Models\Book; // Importar el modelo Book
use Illuminate\Http\Request; // Importar la clase Request
use Illuminate\Support\Facades\Auth; // Importar la fachada Auth

class BookController extends Controller
{
    /**
     * Muestra una lista de todos los libros.
     */
    public function index()
    {
        $books = Book::all(); // Obtener todos los libros

        return view('books.index', compact('books')); // Pasar los libros a la vista
    }

    /**
     * Muestra el formulario para crear un nuevo libro.
     */
    public function create()
    {
        return view('books.create'); // Retornar la vista para crear un nuevo libro
    }

    /**
     * Almacena un nuevo libro en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([ // Validar los datos del formulario
            'title' => 'required|string|max:255', // El título es requerido, debe ser una cadena y tener máximo 255 caracteres
            'year' => 'required|integer', // El año es requerido y debe ser un número entero
            'author' => 'required|string|max:255', // El autor es requerido, debe ser una cadena y tener máximo 255 caracteres
            'publisher' => 'required|string|max:255', // La editorial es requerida, debe ser una cadena y tener máximo 255 caracteres
        ]);

        Book::create($request->all()); // Crear un nuevo libro con los datos del formulario

        return redirect()->route('books.index')->with('success', 'Book created successfully.'); // Redirigir a la lista de libros con un mensaje de éxito
    }

    /**
     * Muestra los detalles de un libro específico.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book')); // Pasar el libro a la vista
    }

    /**
     * Muestra el formulario para editar un libro.
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book')); // Pasar el libro a la vista de edición
    }

    /**
     * Actualiza un libro existente en la base de datos.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([ // Validar los datos del formulario
            'title' => 'required|string|max:255',
            'year' => 'required|integer',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
        ]);

        $book->update($request->all()); // Actualizar el libro con los datos del formulario

        return redirect()->route('books.index')->with('success', 'Book updated successfully.'); // Redirigir a la lista de libros con un mensaje de éxito
    }

    /**
     * Elimina un libro de la base de datos.
     */
    public function destroy(Book $book)
    {
        $book->delete(); // Eliminar el libro
        return redirect()->route('books.index'); // Redirigir a la lista de libros
    }

    // BookController.php

    public function showBooks()
    {
        $books = Book::all();

        if (Auth::check()) {
            // Si el usuario está autenticado, muestra la vista 'dashboard' con los libros
            return view('dashboard', compact('books'));
        } else {
            // Si el usuario no está autenticado, muestra la vista 'home' con los libros
            return view('home', compact('books'));
        }
    }
}
