<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'year', 'author', 'publisher']; // Campos que pueden ser asignados masivamente

    // Método para verificar si un libro está prestado actualmente
    public function isLoaned()
    {
        // Busca si existe algún préstamo para este libro donde el campo 'returned' sea falso
        return $this->loans()->where('returned', false)->exists();
    }

    // Método para obtener los préstamos relacionados con este libro
    public function loans()
    {
        // Define una relación uno a muchos con el modelo Loans
        return $this->hasMany(Loans::class);
    }
}
