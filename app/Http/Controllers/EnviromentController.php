<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnviromentController extends Controller
{
    public function index()
    {
        $data = [
            'host' => env('DB_HOST_SQLSERVER'),
            'port' => env('DB_PORT_SQLSERVER'),
            'database' => env('DB_DATABASE_SQLSERVER'),
            'user' => env('DB_USERNAME_SQLSERVER'),
            'password'=> env('DB_PASSWORD_SQLSERVER')
        ];
        return view('enviroment',$data);
    }
    public function set(Request $request)
    {
        $rules = [
            '*' => 'required',
            'DB_PORT_SQLSERVER'=> 'integer'
        ];
        $message = [
            'required' => 'El campo es requerido',
            'integer' => 'El campo debe ser numérico'
        ];
        $request->validate($rules,$message);
        $reemplazar = [
            'DB_HOST_SQLSERVER=' . env('DB_HOST_SQLSERVER'),
            'DB_PORT_SQLSERVER=' . env('DB_PORT_SQLSERVER'),
            'DB_DATABASE_SQLSERVER=' . env('DB_DATABASE_SQLSERVER'),
            'DB_USERNAME_SQLSERVER=' . env('DB_USERNAME_SQLSERVER'),
            'DB_PASSWORD_SQLSERVER=' . env('DB_PASSWORD_SQLSERVER'),
        ];
        $reemplazo = [
            'DB_HOST_SQLSERVER=' . $request->DB_HOST_SQLSERVER,
            'DB_PORT_SQLSERVER=' . $request->DB_PORT_SQLSERVER,
            'DB_DATABASE_SQLSERVER=' . $request->DB_DATABASE_SQLSERVER,
            'DB_USERNAME_SQLSERVER=' . $request->DB_USERNAME_SQLSERVER,
            'DB_PASSWORD_SQLSERVER=' . $request->DB_PASSWORD_SQLSERVER,
        ];
        file_put_contents(
            app()->environmentFilePath(), 
            str_replace(
                $reemplazar,
                $reemplazo,
                file_get_contents(app()->environmentFilePath())
        ));
        return redirect()->route('dashboard')->with('success','La base de datos ha sido actualizada');
    }
}
