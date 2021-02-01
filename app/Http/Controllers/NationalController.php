<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class NationalController extends Controller
{
    public function addNational()
    {
        return view('national_hospital');
    }
    public function nationalList()
    {
        $nationals = DB::table('nationals')->get();
        return view('national_hospital', compact('nationals'));
    }

    public function saveNational(Request $request)
    {
        DB::table('nationals')->insert([
            'name'=>$request->name,
            'category'=>'national',
            'number_of_health_officers'=>$request->number_of_health_officers

        ]);
        return back()->with('add_national', 'Hospital registered successfully');
    }
}
