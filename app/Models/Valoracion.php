<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    use HasFactory;

    protected $table = 'valoraciones';

    protected $fillable = ['producto_id', 'user_id', 'puntuacion', 'comentario'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
