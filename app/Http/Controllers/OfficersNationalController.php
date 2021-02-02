<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\national;
use DB;

class OfficersNationalController extends Controller
{
    public function addNationalOfficer()
    {
        return view('officersNational');
    }

    public function officerNationalList()
    {
        $officersNational = DB::table('officer_nationals')->get();
        return view('officersNational', compact('officersNational'));
    }
  
    public function saveOfficerNational(Request $request)
    {
        $nationals = national::get();
        $findMin = array();
        if(count($nationals)===0 ){
            return back()->with('status', 'National Hospitals do not have data');
        }
        $nationalHospital = array();
        foreach($nationals as $result){
            array_push($findMin, $result->number_of_health_officers);
        }
        sort($findMin);
        if($findMin[0] < 100){
            foreach($nationals as $result){
                $result->number_of_health_officers === $findMin[0]?
                array_push($nationalHospital, $result)
                :
                null;
            }
            DB::table('nationals')
            ->where('number_of_health_officers', '=', $findMin[0])->increment('number_of_health_officers', 1);

        DB::table('officer_nationals')->insert([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'district'=>$request->district,
            'position'=>$request->position,
            'number_of_patients_treated'=>$request->number_of_patients_treated,
            'hospital_name'=>$nationalHospital[0]->name,

        ]);
            return back()->with('officersNational', 'health officer registered successfully');
        } else {
            return back()->with('notFound', 'All National hospitals are full');
        }
            

    }
}


