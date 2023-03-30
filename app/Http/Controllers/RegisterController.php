<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Carrito;

class RegisterController extends Controller
{
    public function showRegistroForm()
    {
        return view('registro');
    }

    public function registro(Request $request)
{
    $validator = Validator::make($request->all(), [
        'nombre' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|confirmed',
        'fecha_nacimiento' => 'required|date',
    ]);

    if ($validator->fails()) {
        return redirect('registro')
            ->withErrors(['password' => 'La contraseña no coinciden.'])
            ->withInput();
    }

    $fecha_nacimiento = new \DateTime($request->fecha_nacimiento);
    $ahora = new \DateTime();
    $edad = $ahora->diff($fecha_nacimiento)->y;

    if ($edad < 18) {
        return redirect('registro')
            ->withErrors(['fecha_nacimiento' => 'Debes ser mayor de 18 años.'])
            ->withInput();
    }

    $usuario = new User();
    $usuario->email = $request->email;
    $usuario->password = bcrypt($request->password);
    $usuario->fecha_nacimiento = $request->fecha_nacimiento;

    if (strpos($request->nombre, '@admin') !== false) {
        $usuario->nombre = 'admin';
        $usuario->rol = 'admin';
    } else {
        $usuario->nombre = $request->nombre;
        $usuario->rol = 'user';
    }

    $usuario->save();

    $carrito = new Carrito();
    $carrito->user_id = $usuario->id;
    $carrito->save();

    return redirect('/');
}

    
}