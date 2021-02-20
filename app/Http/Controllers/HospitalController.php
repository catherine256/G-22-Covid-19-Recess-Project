<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HospitalController extends Controller
{
    public function addHospital() 
    {
        return view('add_hospital');
    }
    public function HospitalList()
    {
        $hospitals = DB::table('hospitals')->get();
        return view('hospital', compact('hospitals'));
    }

    public function saveHospital(Request $request)
    {
        DB::table('hospitals')->insert([
            'name'=>$request->name,
            'category'=>'general',
            'number_of_health_officers'=>$request->number_of_health_officers

        ]);
        return back()->with('add_hospital', 'Hospital registered successfully');
    }
    
    public function hospitalGraph()
    {
        $hospitals = DB::table('hospitals')->get();
       return view('hospital_graph',['hospitals' => $hospitals]);   
    }
}
 
