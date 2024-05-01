<?php

namespace App\Http\Controllers\RegisterManagement;

use App\Http\Controllers\Controller;
use App\Models\RegisterManagement\Registration;
use App\Models\RegisterManagement\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('pages.register-management.student');
    }

    public function print($id)
    {
        return view('prints.student', [
            'student' => Student::query()->with(['period', 'region', 'guardian', 'diniyah', 'formal'])->find($id)
        ]);
    }
}
