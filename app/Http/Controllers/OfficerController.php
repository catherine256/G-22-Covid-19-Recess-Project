<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\hospitals;
use  Illuminate\Support\Facades\Validator;


class OfficerController extends Controller
{
    public function addOfficer()
    {
        return view('registerhealthofficer');
    }


    public function officerList()
    {
        $officers = DB::table('officers')->get();
        return view('healthofficerlists', compact('officers'));
    }


    public function saveOfficer(Request $request)
    {
        $generals = hospitals::get();
        $findMin = array();
        if(count($generals)===0 ){
            return back()->with('status', 'General Hospitals do not have data');
        }
        $generalHospital = array();
        foreach($generals as $result){
            array_push($findMin, $result->number_of_health_officers);
        }
        sort($findMin);
        if($findMin[0] < 15){
            foreach($generals as $result){
                $result->number_of_health_officers === $findMin[0]?
                array_push($generalHospital, $result)
                :
                null;
            }
            DB::table('hospitals')
            ->where('number_of_health_officers', '=', $findMin[0])->increment('number_of_health_officers', 1);


        DB::table('officers')->insert([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'district'=>$request->district,
            'position'=>$request->position,
            'number_of_patients_treated'=>$request->number_of_patients_treated,
            'hospital_name'=>$generalHospital[0]->name,
            'hospital_id'=>$generalHospital[0]->hospital_id,


        ]);
            return back()->with('registerhealthofficer', 'health officer registered successfully');
        } else {
            return back()->with('notFound', 'all general hospitals are full');
        }
            

    }


    public function editOfficer($id)
    {
        $officers = DB::table('officers')->where('id', $id)->first();
        return view('edit_officer', compact('officers'));
    }


    public function updateOfficer(Request $request)
    {
        
        DB::table('officers')->where('id', $request->id)->update([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'district'=>$request->district,
            'position'=>$request->position,
            'number_of_patients_treated'=>$request->number_of_patients_treated,
            'hospital_name'=>$request->hospital_name,
        ]);
        
        return back()->with('officer_update', 'Health officer updated successfully');
    }


    public function deleteOfficer($id)
    {
        DB::table('officers')->where('id', $id)->delete();
        return back()->with('officer_delete', 'Health Officer Deleted successfully');
    }

}
