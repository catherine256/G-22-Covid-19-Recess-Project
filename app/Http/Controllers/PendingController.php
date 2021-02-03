<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\officer;
use App\Models\officer_regional;
use App\Models\officer_national;

class PendingController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    protected  $general_officer_id;
    protected  $referal_officer_id;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    //   public totalPatientsNumber(){

    //   }

    protected function check_general_treated_patients($officer_array){
          $treated_patients =  array_filter($officer_array,function($officers){
            if($officers->number_of_patients_treated > 100){
                $this->general_officer_id = $officers->id;
                return $officers;
            } 
           }
        );
        if(count($treated_patients)){
            $officer_total = DB::table('regionals')->min('number_of_health_officers');
            $hospital_details = DB::table('regionals')->where('number_of_health_officers', $this->general_officer_id)->get();
            $officer_details = DB::table('hospitals')->where('id', '=', $this->general_officer_id)->get();
    

           //insert 

           DB::table('officer_regionals')->insert([
            'officer_name' =>$officer_details[0]->name ,
            'role'=>'senior officer',
            'hospital_id'=>$hospital_details[0]->id,
            'user_id'=>1,
            'hospital_name'=>$hospital_details[0]->hospital_name
        ]);

        //increment regional hospital

        return 
        DB::table('regional_hospitals')->where('officer_total', '=', $officer_total)->increment('officer_total', 1);



        }
        else{
            return ;
        }
    }
    protected  function check_referal_table($officer_array){
        $treated_patients =  array_filter($officer_array,function($officers){
            if($officers->number_of_patients_treated > 900){
                $this->referal_officer_id = $officers->id;
                return $officers;
            }
           }
        );
        if(count($treated_patients)){
        return 
        DB::table('officer_regionals')
              ->where('id', $this->referal_officer_id)
              ->update([
                  'upgrade' => 'covid 19 consultant',
                   'award'=>'10000000',
                   'pending'=>True
              ]);



        }
        else{
            return ;
        }

    }
    protected function pendingOfficerList(){
        return DB::table('officer_regionals')
        ->where('pending', True)
        ->get();
    }
   protected function format_currency($array_currency){
    return  array_map(function($currency){
        if($currency->award){
           $currency->award = number_format($currency->award, 2, '.', ',');
           $currency->pending = 'Yes';
           return $currency;
        }
        return $currency;
   }, $array_currency);
}
   
    public function PendingList()
    {
      $pendingList = $this->pendingOfficerList();
      $this->format_currency($pendingList->toArray());
       return view('pending_list',
       [
        'officers_pending'=>$pendingList
       ]

    );
    }
}
