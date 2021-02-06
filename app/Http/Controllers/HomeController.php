<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\patient;
use App\Models\officer;
use DB;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }
    protected function officerTotal(){
        return 
        $officers_total =DB::table('officers')->get();
   
    }

    protected function patientTotal(){
        return 
        $patients_total =DB::table('covid-19-cases')->get();
   
    }
    public function index()
    {
        $officers_total = $this->officerTotal();
        $patients_total=$this->patientTotal();
         return view('home',
        [
        'officers_total'=>$officers_total,
        'patients_total'=>$patients_total,
        ]);
    }
}
