<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ConsultasController extends Controller
{
    public function validarUsuario(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $password = $request->password;

        if ($user && Hash::check($password, $user->password)) {
            $sucursales = $user->sucursales;
            return response()->json($sucursales);
        }else{
            $error = 'Las credenciales ingresadas son incorrectas';
            return response($error,404);
        }

    }
}
