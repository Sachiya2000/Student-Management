<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Domain\Facades\StudentFacade;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        return StudentFacade::index();
    }

    public function create()
    {
        return StudentFacade::create();
    }

    public function store(Request $request)
    {
        return StudentFacade::store($request);
    }

    public function edit(Student $student)
    {
        return StudentFacade::edit($student);
    }

    public function update(Request $request, Student $student)
    {
        return StudentFacade::update($request, $student);
    }

    public function destroy(Student $student)
    {
        return StudentFacade::destroy($student);
    }

    public function changeStatus(Student $student)
    {
        return StudentFacade::changeStatus($student);
    }
}
