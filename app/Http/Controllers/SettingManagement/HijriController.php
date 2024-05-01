<?php

namespace App\Http\Controllers\SettingManagement;

use App\Http\Controllers\Controller;
use App\Imports\HijriImport;
use App\Models\RegisterManagement\Diniyah;
use App\Models\RegisterManagement\Domicile;
use App\Models\RegisterManagement\Formal;
use App\Models\RegisterManagement\Registration;
use App\Models\RegisterManagement\Student;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class HijriController extends Controller
{
    public function index(): View
    {
        return view('pages.setting-management.hijri', [
            'hijri' => hijri(), 'masehi' => Carbon::now()->toDateString()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx,xls'
        ]);

        $file = $request->file('file');
        $name = rand().$file->getClientOriginalName();
        $file->move('imports', $name);

        Excel::import(new HijriImport, public_path('imports/'.$name));

        if (\File::exists(public_path('imports/'.$name))) {
            \File::delete(public_path('imports/'.$name));
        }

        Session::flash('success','Data Kalender Berhasil Diimport!');

        return redirect()->route('setting-management.hijri');
    }

    public function configDomicile()
    {
        $students = Student::where('status', '!=', 0)->get();
        foreach ($students as $student) {
            Domicile::create([
                'period_id' => Auth::user()->current_period,
                'student_id' => $student->id,
                'domicile_status' => $student->domicile_status,
                'domicile' => $student->domicile,
                'domicile_number' => $student->domicile_number,
                'is_new' => 0,
                'note' => 'Migrasi sistem v1 ke v2',
                'created_at_hijri' => hijri()
            ]);
        }

        return redirect()->route('setting-management.hijri');
    }

    public function configDiniyah()
    {
        $students = Student::where('status', '!=', 0)->get();
        foreach ($students as $student) {
            Diniyah::create([
                'period_id' => Auth::user()->current_period,
                'student_id' => $student->id,
                'grade' => $student->grade_of_diniyah,
                'institution_id' => $student->institution_diniyah_id,
                'is_new' => 0,
                'note' => 'Migrasi sistem v1 ke v2',
                'created_at_hijri' => hijri()
            ]);
        }

        return redirect()->route('setting-management.hijri');
    }

    public function configFormal()
    {
        $students = Student::where('status', '!=', 0)->get();
        foreach ($students as $student) {
            Formal::create([
                'period_id' => Auth::user()->current_period,
                'student_id' => $student->id,
                'grade' => $student->grade_of_formal,
                'institution_id' => $student->institution_formal_id,
                'is_new' => 0,
                'note' => 'Migrasi sistem v1 ke v2',
                'created_at_hijri' => hijri()
            ]);
        }

        return redirect()->route('setting-management.hijri');
    }

    public function configRegistration()
    {
        $students = Student::where('status', '!=', 0)->get();
        foreach ($students as $student) {
            Registration::query()->create([
                'id' => $student->id,
                'domicile_status' => $student->domicile_status,
                'domicile' => $student->domicile,
                'domicile_number' => $student->domicile_number,
                'is_new_domicile' => false,
                'grade_of_diniyah' => $student->grade_of_diniyah,
                'institution_diniyah_id' => $student->institution_diniyah_id,
                'is_new_diniyah' => false,
                'grade_of_formal' => $student->grade_of_formal,
                'institution_formal_id' => $student->institution_formal_id,
                'is_new_formal' => false,
                'created_at_hijri' => hijri()
            ]);
        }

        return redirect()->route('setting-management.hijri');
    }
}
