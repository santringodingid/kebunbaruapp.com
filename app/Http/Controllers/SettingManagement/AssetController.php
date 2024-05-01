<?php

namespace App\Http\Controllers\SettingManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        return view('pages.setting-management.asset');
    }

    public function store(Request $request)
    {
//        $request->validate([
//            'images' => 'required',
//            'images.*' => 'jpg,png,jpeg'
//        ]);

        if($request->hasfile('images'))
        {
            foreach($request->file('images') as $key => $file)
            {
                $name = $file->getClientOriginalName();
                $file->storeAs('public/assets', $name);
            }
        }

        return redirect()->route('setting-management.asset')->with('success', 'Images has been uploaded successfully');
    }
}
