<?php

namespace App\Http\Controllers\SettingManagement;

use App\Http\Controllers\Controller;
use App\Imports\HijriImport;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
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
}
