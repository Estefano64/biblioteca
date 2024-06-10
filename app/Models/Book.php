<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'year', 'author', 'publisher'];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
