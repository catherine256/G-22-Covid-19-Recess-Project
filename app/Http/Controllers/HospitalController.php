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
    public function editHospital($hospital_id)
    {
        $hospitals = DB::table('hospitals')->where('hospital_id', $hospital_id)->first();
        return view('edit_hospital', compact('hospitals'));
    }

    public function updateHospital(Request $request)
    {
        DB::table('hospitals')->where('hospital_id', $request->hospital_id)->update([
            'name'=>$request->name,
            'category'=>$request->category,
            'number_of_health_officers'=>$request->number_of_health_officers

        ]);
        return back()->with('hospital_update', 'Hospital updated successfully');
    }

    public function deleteHospital($hospital_id)
    {
        DB::table('hospitals')->where('hospital_id', $hospital_id)->delete();
        return back()->with('hospital_delete', 'Hospital Deleted successfully');
    }

    public function hospitalGraph()
    {
        $hospitals = DB::table('hospitals')->get();
       return view('hospital_graph',['hospitals' => $hospitals]);   
    }
}
 
