<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RegionalController extends Controller
{
    public function addRegional()
    {
        return view('regional_hospital');
    }
    public function RegionalList()
    {
        $regionals = DB::table('regionals')->get();
        return view('regional_hospital', compact('regionals'));
    }

    public function saveRegional(Request $request)
    {
        DB::table('regionals')->insert([
            'name'=>$request->name,
            'category'=>'regional',
            'number_of_health_officers'=>$request->number_of_health_officers

        ]);
        return back()->with('add_regional', 'Hospital registered successfully');
    }

}
