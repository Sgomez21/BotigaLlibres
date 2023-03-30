<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class userAuth extends Controller
{
    function login(Request $req)
    {
        $validated = $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = DB::table('users')
            ->where('email', $validated['email'])
            ->first();

        if ($user && password_verify($validated['password'], $user->password)) {
            $req->session()->put('user', $user);
            return redirect('/');
        } else {
            return redirect('login')->withErrors([
                'general' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
            ]);
        }
    }
}
