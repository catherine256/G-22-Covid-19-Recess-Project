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

    protected function officers_referal_hospital(){
        return
        $officers_referal_hospital = DB::table('officer_regionals')
        ->select('officer_regionals.name','officer_regionals.id','officer_regionals.username','officer_regionals.email',
        'officer_regionals.district','officer_regionals.position','officer_regionals.number_of_patients_treated','officer_regionals.hospital_name',
        )->get();
    }
    protected function officers_national_hospital(){
        return 
        $officers_national_hospital =DB::table('officer_nationals')
        ->select('officer_nationals.name','officer_nationals.id','officer_nationals.username','officer_nationals.email',
        'officer_nationals.district','officer_nationals.position','officer_nationals.number_of_patients_treated','officer_nationals.hospital_name',
        )->get();
   
    }

    protected function check_general_treated_patients($officer_array){
          $number_of_patients_treated =  array_filter($officer_array,function($officers){
            if($officers->number_of_patients_treated > 100){
                $this->general_officer_id = $officers->id;
                return $officers;
            } 
           }
        );
        if(count($number_of_patients_treated)){
            $officer_total = DB::table('regionals')->min('number_of_health_officers');
            $hospital_details = DB::table('regionals')->where('number_of_health_officers', $this->general_officer_id)->get();
            $officer_details = DB::table('hospitals')->where('id', '=', $this->general_officer_id)->get();
    

           //insert 

           DB::table('officer_regionals')->insert([
            'name' =>$officer_details[0]->name ,
            'username' =>$officer_details[0]->username ,
            'email' =>$officer_details[0]->email ,
            'district' =>$officer_details[0]->district ,
            'position'=>'senior covid-19 health  officer',
            'number_of_patients_treated'=>$officer_details[0]->number_of_patients_treated,
            'hospital_name'=>$hospital_details[0]->hospital_name
        ]);

        //increment regional hospital

        return 
        DB::table('regional_hospitals')->where('number_of_health_officers', '=', $officer_total)->increment('number_of_health_officers', 1);



        }
        else{
            return ;
        }
    }
    protected  function check_referal_table($officer_array){
        $number_of_patients_treated =  array_filter($officer_array,function($officers){
            if($officers->number_of_patients_treated > 900){
                $this->referal_officer_id = $officers->id;
                return $officers;
            }
           }
        );
        if(count($number_of_patients_treated)){
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

        $officers_referal_hospital =  $this->officers_referal_hospital();
        $officers_national_hospital = $this->officers_national_hospital();
        $this->check_referal_table($officers_referal_hospital->toArray());
        $pendingList = $this->pendingOfficerList();
        $this->format_currency($pendingList->toArray());
         return view('pending_list',
        [
        'officers_pending'=>$pendingList,
        'officers_regional'=>$officers_referal_hospital,
        'officers_national'=>$officers_national_hospital,
        ]);
    }

    public function officersRegional()
    {

        $officers_referal_hospital =  $this->officers_referal_hospital();
        $this->check_referal_table($officers_referal_hospital->toArray());
         return view('officersRegional',
        [
        'officers_regional'=>$officers_referal_hospital,
        ]);
    }

    public function officersNational()
    {
        $officers_national_hospital = $this->officers_national_hospital();
         return view('officersNational',
        [
        'officers_national'=>$officers_national_hospital,
        ]);
    }

}
