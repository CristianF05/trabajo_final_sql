<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante; // Importar el modelo Estudiante

class EstudianteController extends Controller
{
    public function index()
    {
        return view('vista');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'salon' => 'required|string|max:255',
            'grado' => 'required|string|max:255',
            'dni' => 'required|string|unique:estudiantes,dni|max:255',
        ]);

        // Crear un nuevo estudiante en la base de datos
        Estudiante::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'salon' => $request->salon,
            'grado' => $request->grado,
            'dni' => $request->dni,
        ]);

        // Redireccionar con un mensaje de éxito
        return redirect()->back()->with('success', 'Estudiante registrado correctamente.');
    }
}
