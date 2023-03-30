<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function add(Request $r)
    {
        $categoria = new Categoria();
        $categoria->nombre = $r->nombre;
        $categoria->descripcion = $r->descripcion;
        $categoria->save();
        return redirect('/add');
    }
}
