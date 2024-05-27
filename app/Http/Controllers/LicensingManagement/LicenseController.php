<?php

namespace App\Http\Controllers\LicensingManagement;

use App\Http\Controllers\Controller;
use App\Models\LicensingManagement\License;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    public function index()
    {
        return view('pages.licensing-management.license');
    }

    public function print($id)
    {
        $license = License::query()->with('petition', function ($query){
            $query->withWhereHas('student', function ($query) {
                $query->with('region');
            })->withWhereHas('registration', function ($query) {
                $query->with('diniyah', 'formal');
            });
        })->with('createdBy')->find($id);

        return view('prints.license', compact('license'));
    }
}
