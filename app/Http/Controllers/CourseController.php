<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\RoboticsKit;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->rol == "student"){
            abort(403);
        }
        $courses = Course::with('roboticsKit')->get();
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kits = RoboticsKit::all();
        return view('courses.create', compact('kits'));
    }

    /** 
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar primero (para evitar subir archivos inválidos)
        $request->validate([
            'course_key' => 'required|string|max:255',
            'course_name' => 'required|string|max:255',
            'robotics_kit_id' => 'required|exists:robotics_kits,id',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048', 
        ]);

        // Procesar la imagen
        if ($request->hasFile('image')) {
            $archivo = $request->file('image');
            $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();

            // Mover al directorio public/courses
            $archivo->move(public_path('courses_files'), $nombreArchivo);

            // Guardar solo el nombre o la ruta relativa
            $rutaImagen = 'courses/' . $nombreArchivo;
        } else {
            $rutaImagen = null;
        }

        // Crear el registro
        $course = new Course();
        $course->course_key = $request->input('course_key');
        $course->course_name = $request->input('course_name');
        $course->robotics_kit_id = $request->input('robotics_kit_id');
        $course->image = $rutaImagen;
        $course->save();

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::with('roboticsKit')->findOrFail($id);
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::findOrFail($id);
        $kits = RoboticsKit::all();
        return view('courses.edit', compact('course', 'kits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'course_key' => 'required|string|max:255',
            'course_name' => 'required|string|max:255',
            'robotics_kit_id' => 'required|exists:robotics_kits,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $course = Course::findOrFail($id);

        $data = [
            'course_key' => $request->course_key,
            'course_name' => $request->course_name,
            'robotics_kit_id' => $request->robotics_kit_id,
        ];

        if ($request->hasFile('image')) {
            $archivo = $request->file('image');
            $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
            $archivo->move(public_path('courses'), $nombreArchivo);
            $data['image'] = 'courses/' . $nombreArchivo;
        }

        $course->update($data);

        return redirect()->route('courses.show', $course->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index');
    }
}