<?php

namespace Domain\Services;

use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class StudentService
{
    public function index()
    {
        $students = Student::all();
        return Inertia::render('Dashboard', [
           'students' => $students
        ]);

    }

    public function create()
    {
        return Inertia::render('AddStudent', [
            'storeRoute' => route('students.store')
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|max:4048',
            'age' => 'required|integer',
        ]);

        $imagePath = $request->file('image')->store('images/students', 'public');

        Student::create([
            'name' => $request->name,
            'image' => $imagePath,
            'age' => $request->age,
        ]);


    }

    public function edit(Student $student)
    {
        return Inertia::render('EditStudent', [
            'student' => $student
        ]);
    }

    public function update(Request $request, Student $student)
    {
        Log::info('Update request data', $request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'age' => 'required|integer',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/students', 'public');
            $student->image = $imagePath;
        }

        $student->name = $request->name;
        $student->age = $request->age;
        $student->save();
        return redirect()->route('dashboard');


    }

    public function destroy(Student $student)
    {
        $student->delete();

    }

    public function changeStatus(Student $student)
    {
        $student->status = !$student->status;
        $student->save();


    }
}
