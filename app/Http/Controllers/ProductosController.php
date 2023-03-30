<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Carrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Valoracion;

class ProductosController extends Controller
{
    public function index()
    {
        $productos = Producto::all(); 
        return view('welcome', ['productos' => $productos]);
    }

    public function addForm(Request $r)
    {
        $categories = Categoria::all();
        return view("anadirproductos", ['categorias' => $categories]);
    }

    public function añadirProducto(Request $r)
    {
        $producto = new Producto();
        $producto->nombre = $r->nombre;
        $producto->descripcion = $r->descripcion;
        $producto->precio = $r->precio;
        $path = $r->img->store('imagenes', 'public');
        $producto->img = $path;
        $producto->categoria_id = $r->categoria_id;
        $producto->save();
        return redirect('/show');
    }
    public function mostrar(Request $r)
    {
        $producto = Producto::all();
        $categorias = Categoria::all();
        return view("welcome", ['productos' => $producto, 'categorias' => $categorias]);
    }

    public function modificar(Request $r)
    {
        $producto = Producto::find($r->id);
        $categoria = Categoria::all();
        return view("modificarproducto", ['producto' => $producto, 'categoria' => $categoria]);
    }
    public function mostrar_producto($id)
    {
        $producto = Producto::findOrFail($id);
        $valoracion = Valoracion::where('producto_id',$id)->get();
        return view("mostrarproductos", ['producto' => $producto, 'valoracion'=>$valoracion]);
    }


    public function actualizar(Request $r)
    {
        $producto = Producto::find($r->id);
        $producto->nombre = $r->nombre;
        $producto->descripcion = $r->descripcion;
        $producto->precio = $r->precio;
        $producto->categoria_id = $r->categoria_id;

        Storage::delete('public/'.$producto->img);

        $path = $r->img->store('imagenes', 'public');
        $producto->img = $path;

        $valoraciones = Valoracion::where('producto_id', $r->id)->get();
        foreach ($valoraciones as $valoracion) {
            $valoracion->delete();
        }

        $producto->save();
        return redirect('/show');
    }
    public function borrar(Request $r)
    {
        $producto = Producto::find($r->id);
    
        // Eliminar el producto del carrito de todos los usuarios
        $carritos = Carrito::where('producto_id', $r->id)->get();
        foreach ($carritos as $carrito) {
            $carrito->delete();
        }
    
        $valoraciones = Valoracion::where('producto_id', $r->id)->get();
        foreach ($valoraciones as $valoracion) {
            $valoracion->delete();
        }
    
        Storage::delete('public/'.$producto->img);
        $producto->delete();
    
        return redirect('/show');
    }
    
    public function obtenerProducto($id_producto)
    {
        return Producto::find($id_producto);
    }

    public function añadir_valoracion(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
    
        $valoracion = new Valoracion();
        $valoracion->puntuacion = $request->puntuacion;
        $valoracion->comentario = $request->comentario;
        $valoracion->user_id = session('user')->id;
        $valoracion->producto_id = $producto->id;
        $valoracion->save();
    
        return redirect()->back();
    }
    
}
