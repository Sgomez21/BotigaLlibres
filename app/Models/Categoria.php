<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
        protected $fillable = [
            'Nombre','Descripcion'
        ];
    
        public function productos()
        {
            return $this->hasOne(Producto::class);
        }
    use HasFactory;
}
