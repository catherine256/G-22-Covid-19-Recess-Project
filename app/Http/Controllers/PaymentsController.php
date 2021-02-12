<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model;
use DB;

class PaymentsController extends Controller
{
    public string $default_month;
    public  string $set_month;
    public $set =False;
    protected function  getFromStore(){

        if($this->set){
              $store_month = $this->set_month;
            $donor_money = DB::table('treasury')
            ->select('amount')
            ->where('date_declared', '=', $store_month)
            ->get();  
            $this->default_month = $store_month;
            return $donor_money[0]->amount;
      
    
         }
         else{
            $donor_money = DB::table('treasury')
            ->select('amount')->get();
            // ->where('treasury_id', '=', 1)
            $this->default_month = 'date_declared';
            return $donor_money[0]->amount;
      
         }
    }
    
   
    private function cal_excess_amount($first_amount, $second_amount){
        if((int)$first_amount > (int)$second_amount){
            $diff = (int)$first_amount-(int)$second_amount;
            return (int)$diff;
        }
        else return 'less amount';
    }
    private function  cal_payments($first_amount, $second_amount){
        $remaining_amount = (int)$first_amount-(int)$second_amount;
        return (int)$remaining_amount;
    }
    //calculate officer total
    private function number_of_health_officers($array){
        return count($array);
    }
    private function  format_currency($array_currency){
       return  array_map(function($currency){
             if($currency->monthly_allowance){
                $currency->monthly_allowance = number_format($currency->monthly_allowance, 2, '.', ',');
                return $currency;
             }
             else{
                 $currency->monthly_allowance = number_format($currency->monthly_allowance,2);
                 return $currency;
             }
        }, $array_currency);
    }

    public function index()
    {  
       $diff_money = $this->cal_payments((int)$this->getFromStore(),(int)100000000 );
        $months = DB::table('treasury')->select('date_declared')
        ->where('amount', ">", 100000000)
        ->get();
      if($diff_money >0){
        $remaining_amount = $this->cal_payments($diff_money, 5000000);
        $director_money_national_referal = 5000000;
        $superintendent_money = $director_money_national_referal/2;
        $remaining_after_superintendent = $this->cal_payments($remaining_amount, $superintendent_money);
        $administrator_money = $superintendent_money*(3/4);
        $remaining_after_admin = $this->cal_payments($remaining_after_superintendent, $administrator_money);

        //calculate total officers in general hospitals
        $total_officers_general = $this->number_of_health_officers(DB::select('select position from officers'));

        //officers general hospital salary
        $general_officer_salary = $administrator_money*(8/5);
        $total_officer_salary = $general_officer_salary*$total_officers_general;
        $remaining_after_general_officer_salary = $this->cal_payments($remaining_after_admin, $total_officer_salary);

        //echo $remaining_after_general_officer_salary;

        //total senior officers
        $senior_officer_salary = $general_officer_salary + $general_officer_salary*(6/100);
        $total_senior_officers = $this->number_of_health_officers(DB::select(
            'select position from officer_regionals where position = ?', ['senior covid-19 health officer']));
        $total_senior_officer_salary = $total_senior_officers*$senior_officer_salary;
    
        $remaining_amount_after_senior_officers = $this->
        cal_payments($remaining_after_general_officer_salary, $total_senior_officers);

        //total officers money apart from general
        $all_officer_salary = $director_money_national_referal+$administrator_money
        + $superintendent_money + $senior_officer_salary;
        $bonus_general_officers = $all_officer_salary*(3.5/100);

        $general_officer_salary+=$all_officer_salary;
        //echo $general_officer_salary;
        $total_general_officer_salary =  $total_officers_general*$general_officer_salary;

        $remaining_after_general_officer_bonus = $this->
        cal_payments($remaining_amount_after_senior_officers, $total_general_officer_salary);

        //echo $remaining_after_general_officer_bonus;

        //total money plus the bonus money

        $director_money_national_referal+=($remaining_after_general_officer_bonus*(5/100));
        $superintendent_total_salary = $director_money_national_referal/2;
        $admin_total_salary  = $superintendent_total_salary*(3/4);
        $officer_total_salary = $admin_total_salary*(8/5);
        $senior_total_salary = $officer_total_salary + $officer_total_salary*(6/100);
        $all_officer_salary = $director_money_national_referal + $superintendent_total_salary +$admin_total_salary
        +$senior_total_salary;
        $officer_total_general_salary = $officer_total_salary + $all_officer_salary*(3.5/100);

        $money = '200';

        //updating records
          DB::update("update officer_nationals set monthly_allowance = $director_money_national_referal
          where position = ?", ['director']);
          DB::update("update officer_regionals set monthly_allowance = $superintendent_total_salary
          where position = ?", ['superintendent']);
          DB::update("update officer_regionals set monthly_allowance = $senior_total_salary
          where position = ?", ['senior covid-19 health officer']);
          DB::update("update officers set monthly_allowance = $officer_total_salary
          where position = ?", ['covid-19 health officer']);
          DB::update("update officers set monthly_allowance = $officer_total_general_salary
          where position = ?", ['head covid-19 health officer']); 
          DB::update("update users set monthly_allowance = $director_money_national_referal
          where role = ?", ['director']);
          DB::update("update users set monthly_allowance = $admin_total_salary
          where role = ?", ['administrator']);  



        
          //return a view
          $staff_money = $this->format_currency(DB::select("select role, name, monthly_allowance from users"));
          $officers_at_general_hospitals = $this->format_currency(DB::select('select position,name, monthly_allowance
           from officers'));
           $officers_at_referal_hospitals = $this->format_currency(DB::select('select position, 
           name, monthly_allowance
           from officer_regionals'));
           $officers_at_national_hospitals = $this->format_currency(DB::select('select position, name, 
           monthly_allowance
           from officer_nationals'));
           return view('payments',
           ['staff_payments'=>$staff_money,
           'officers_at_general'=>$officers_at_general_hospitals,
           'officers_at_referal'=>$officers_at_referal_hospitals,
           'officers_at_national'=>$officers_at_national_hospitals,
           'months'=>$months,
           'default'=>$this->default_month
           ]
        );
          

      }
      else {
          $staff_money = array();
          $officers_at_general_hospitals = array();
          $officers_at_referal_hospitals = array();
          $officers_at_national_hospitals = array();
          $months = array();
        return view('payments',
        ['staff_payments'=>$staff_money,
        'officers_at_general'=>$officers_at_general_hospitals,
        'officers_at_referal'=>$officers_at_referal_hospitals,
        'officers_at_national'=>$officers_at_national_hospitals,
        'months'=>$months,
        'default'=>$this->default_month
        ]);
      }
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function store(Request $request){
        $this->validate($request, 
        ['date_declared'=>'required']
    );
    $this->set_month = $request->date_declared;
    $this->set = True;
   //here


   $diff_money = $this->cal_payments((int)$this->getFromStore(),(int)100000000 );
        $months = DB::table('treasury')->select('date_declared')
        ->where('amount', ">", 100000000)
        ->get();
      if($diff_money>0){
        $remaining_amount = $this->cal_payments($diff_money, 5000000);
        $director_money_national_referal = 5000000;
        $superintendent_money = $director_money_national_referal/2;
        $remaining_after_superintendent = $this->cal_payments($remaining_amount, $superintendent_money);
        $administrator_money = $superintendent_money*(3/4);
        $remaining_after_admin = $this->cal_payments($remaining_after_superintendent, $administrator_money);

        //calculate total officers in general hospitals
        $total_officers_general = $this->number_of_health_officers(DB::select('select position from officers'));

        //officers general hospital salary
        $general_officer_salary = $administrator_money*(8/5);
        $total_officer_salary = $general_officer_salary*$total_officers_general;
        $remaining_after_general_officer_salary = $this->cal_payments($remaining_after_admin, $total_officer_salary);

        //echo $remaining_after_general_officer_salary;

        //total senior officers
        $senior_officer_salary = $general_officer_salary + $general_officer_salary*(6/100);
        $total_senior_officers = $this->number_of_health_officers(DB::select(
            'select position from officer_regionals where position = ?', ['senior covid-19 health officer']));
        $total_senior_officer_salary = $total_senior_officers*$senior_officer_salary;
    
        $remaining_amount_after_senior_officers = $this->
        cal_payments($remaining_after_general_officer_salary, $total_senior_officers);

        //total officers money apart from general
        $all_officer_salary = $director_money_national_referal+$administrator_money
        + $superintendent_money + $senior_officer_salary;
        $bonus_general_officers = $all_officer_salary*(3.5/100);

        $general_officer_salary+=$all_officer_salary;
        //echo $general_officer_salary;
        $total_general_officer_salary =  $total_officers_general*$general_officer_salary;

        $remaining_after_general_officer_bonus = $this->
        cal_payments($remaining_amount_after_senior_officers, $total_general_officer_salary);

        //echo $remaining_after_general_officer_bonus;

        //total money plus the bonus money

        $director_money_national_referal+=($remaining_after_general_officer_bonus*(5/100));
        $superintendent_total_salary = $director_money_national_referal/2;
        $admin_total_salary  = $superintendent_total_salary*(3/4);
        $officer_total_salary = $admin_total_salary*(8/5);
        $senior_total_salary = $officer_total_salary + $officer_total_salary*(6/100);
        $all_officer_salary = $director_money_national_referal + $superintendent_total_salary +$admin_total_salary
        +$senior_total_salary;
        $officer_total_general_salary = $officer_total_salary + $all_officer_salary*(3.5/100);

        $money = '200';

        //updating records
          DB::update("update officer_nationals set monthly_allowance = $director_money_national_referal
          where position = ?", ['director']);
          DB::update("update officers_regionals set monthly_allowance = $superintendent_total_salary
          where position = ?", ['superintendent']);
          DB::update("update officer_regionals set monthly_allowance = $senior_total_salary
          where position = ?", ['senior covid-19 health officer']);
          DB::update("update officers set monthly_allowance = $officer_total_salary
          where position = ?", ['covid-19 health officer']);
          DB::update("update officers set monthly_allowance = $officer_total_general_salary
          where position = ?", ['head covid-19 health officer']); 
          DB::update("update users set monthly_allowance = $director_money_national_referal
          where role = ?", ['director']);
          DB::update("update users set monthly_allowance = $admin_total_salary
          where role = ?", ['administrator']);  



        
          //return a view
          $staff_money = $this->format_currency(DB::select("select role, name, monthly_allowance from users"));
          $officers_at_general_hospitals = $this->format_currency(DB::select('select position, name, monthly_allowance
           from officers'));
           $officers_at_referal_hospitals = $this->format_currency(DB::select('select position, 
           name, monthly_allowance
           from officers_regionals'));
           $officers_at_national_hospitals = $this->format_currency(DB::select('select position, name, 
           monthly_allowance
           from officer_nationals'));
           return view('payments',
           ['staff_payments'=>$staff_money,
           'officers_at_general'=>$officers_at_general_hospitals,
           'officers_at_referal'=>$officers_at_referal_hospitals,
           'officers_at_national'=>$officers_at_national_hospitals,
           'months'=>$months,
           'default'=>$this->default_month
           ]
        );
          

      }
      else {
          $staff_money = array();
          $officers_at_general_hospitals = array();
          $officers_at_referal_hospitals = array();
          $officers_at_national_hospitals = array();
          $months = array();
        return view('payments',
        ['staff_payments'=>$staff_money,
        'officers_at_general'=>$officers_at_general_hospitals,
        'officers_at_referal'=>$officers_at_referal_hospitals,
        'officers_at_national'=>$officers_at_national_hospitals,
        'months'=>$months,
        'default'=>$this->default_month
        ]);
      }
    

   //here
    
    }
}
