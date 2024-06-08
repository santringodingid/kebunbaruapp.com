<?php

namespace App\Http\Controllers\AdministrationManagement;

use App\Http\Controllers\Controller;
use App\Models\RegisterManagement\Student;
use App\Models\Scopes\GenderScope;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        return view('pages.administration-management.guardian-image');
    }

    public function student()
    {
        return view('pages.administration-management.student-image');
    }

    public function signature()
    {
        return view('pages.administration-management.signature');
    }

    public function setSignature()
    {
        $students = Student::withoutGlobalScope(GenderScope::class)->get();
        if($students) {
            foreach ($students as $student) {
                $student->image_of_signature = 'avatars/signatures/'.$student->id.'.png';
                $student->save();
            }
        }

        return redirect()->route('administration-management.signature');
    }
}
