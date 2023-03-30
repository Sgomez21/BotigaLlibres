<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use Illuminate\Http\Request;
use App\Models\Producto;


class CarritoController extends Controller
{
    public function addProduct(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $carrito = Carrito::where('user_id', session('user')->id)
            ->where('producto_id', $producto->id)
            ->first();

        if ($carrito) {

            $carrito->cantidad += 1;
            $carrito->save();
        } else {

            $carrito = new Carrito();
            $carrito->cantidad = 1;
            $carrito->user_id = session('user')->id;
            $carrito->producto_id = $producto->id;
            $carrito->save();
        }

        session()->flash('mensaje', 'El elemento se ha añadido correctamente.');

        return redirect()->back();
    }

    public function mostrarCarrito()
    {
        $user_id = session('user')->id;
        $productos = Carrito::where('user_id', $user_id)->get();

        return view('carrito', ['productos' => $productos]);
    }
    public function borrar_carrito(Request $r)
    {
        $producto = Carrito::find($r->id);
        $producto->delete();
    
        return redirect('/show');
    }
}
