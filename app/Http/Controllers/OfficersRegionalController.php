<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\regional;
use DB;

class OfficersRegionalController extends Controller
{
    public function addRegionalOfficer()
    {
        return view('officersRegional');
    }


    public function officerRegionalList()
    {
        $officersRegional = DB::table('officer_regionals')->get();
        return view('officersRegional', compact('officersRegional'));
    }
  
    public function saveOfficerRegional(Request $request)
    {
        $regionals = regional::get();
        $findMin = array();
        if(count($regionals)===0 ){
            return back()->with('status', 'Regional Hospitals do not have data');
        }
        $regionalHospital = array();
        foreach($regionals as $result){
            array_push($findMin, $result->number_of_health_officers);
        }
        sort($findMin);
        if($findMin[0] < 50){
            foreach($regionals as $result){
                $result->number_of_health_officers === $findMin[0]?
                array_push($regionalHospital, $result)
                :
                null;
            }
            DB::table('regionals')
            ->where('number_of_health_officers', '=', $findMin[0])->increment('number_of_health_officers', 1);


        DB::table('officer_regionals')->insert([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'district'=>$request->district,
            'position'=>$request->position,
            'number_of_patients_treated'=>$request->number_of_patients_treated,
            'hospital_name'=>$regionalHospital[0]->name,


        ]);
            return back()->with('officersRegional', 'health officer registered successfully');
        } else {
            return back()->with('notFound', 'All Regional hospitals are full');
        }
            

    }
}