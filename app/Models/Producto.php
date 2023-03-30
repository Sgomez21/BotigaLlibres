<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
        protected $fillable = [
            'nombre', 'descripcion', 'precio', 'img','categoria_id'
        ];
    
        public function Categoria()
        {
            return $this->belongsTo(Categoria::class);
        }
    
    use HasFactory;
}
