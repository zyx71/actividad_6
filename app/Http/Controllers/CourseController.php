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
        $request->validate([
            'course_key' => 'required|string|max:255',
            'course_name' => 'required|string|max:255',
            'robotics_kit_id' => 'required|exists:robotics_kits,id',
        ]);

        $course = new Course();
        $course->course_key = $request->input('course_key');
        $course->course_name = $request->input('course_name');
        $course->robotics_kit_id = $request->input('robotics_kit_id');
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
        ]);

        $course = Course::findOrFail($id);
        $course->update([
            'course_key' => $request->course_key,
            'course_name' => $request->course_name,
            'robotics_kit_id' => $request->robotics_kit_id
        ]);

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