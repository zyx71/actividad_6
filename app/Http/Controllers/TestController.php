<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    // CREATE → crea un usuario de prueba
    public function create()
    {
        $user = User::create([
            'name' => 'Usuario Demo',
            'email' => 'demo' . rand(1, 1000) . '@correo.com',
            'password' => Hash::make('123456'),
            'rol' => 'admin',
        ]);

        echo "Usuario creado con ID: " . $user->id;
    }

    // GET ALL → lista todos los usuarios
    public function getAll()
    {
        $users = User::all();

        if ($users->isEmpty()) {
            echo "No hay usuarios en la base de datos.";
        } else {
            foreach ($users as $user) {
                echo "ID: {$user->id}, Nombre: {$user->name}, Email: {$user->email}, Rol: {$user->rol}<br>";
            }
        }
    }

    // GET ONE → obtiene un usuario por id
    public function getOne($id)
    {
        $user = User::find($id);

        if ($user) {
            echo "Usuario encontrado → ID: {$user->id}, Nombre: {$user->name}, Email: {$user->email}, Rol: {$user->rol}";
        } else {
            echo "Usuario con ID {$id} no encontrado.";
        }
    }

    // UPDATE → actualiza nombre de usuario por id
    public function update($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->name = "Nombre actualizado " . rand(1, 100);
            $user->save();

            echo "Usuario con ID {$id} actualizado. Nuevo nombre: {$user->name}";
        } else {
            echo "No se pudo actualizar: Usuario con ID {$id} no encontrado.";
        }
    }

    // DELETE → elimina un usuario por id
    public function delete($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            echo "Usuario con ID {$id} eliminado.";
        } else {
            echo "No se pudo eliminar: Usuario con ID {$id} no encontrado.";
        }
    }
}
