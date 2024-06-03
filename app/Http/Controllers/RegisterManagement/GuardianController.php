<?php

namespace App\Http\Controllers\RegisterManagement;

use App\Exports\GuardianExport;
use App\Http\Controllers\Controller;
use App\Models\RegisterManagement\Guardian;
use App\Models\RegisterManagement\Student;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class GuardianController extends Controller
{
    public function index(): View
    {
        return view('pages.register-management.guardian');
    }

    public function export()
    {
        return (new GuardianExport())->download('data-wali-'.session()->get('hijri').'.xlsx');
    }

    public function setImage()
    {
        $guardians = Guardian::where('image', NULL)->get();
        if($guardians->count() > 0){
            foreach($guardians as $guardian){
                $guardian->image = 'avatars/guardians/'.$guardian->id.'.jpg';
                $guardian->save();
            }
        }

        $students = Student::where('image_of_profile', NULL)->get();
        if($students->count() > 0){
            foreach($students as $student){
                $student->image_of_profile = 'avatars/students/'.$student->id.'.jpg';
                $student->image_of_signature = 'images/signatures/'.$student->id.'.png';
                $student->save();
            }
        }

        return redirect()->route('register-management.guardian');
    }
}
