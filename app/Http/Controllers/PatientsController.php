<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PatientsController extends Controller
{
        public function index()
        {
            $patients = DB::table('covid-19-cases')->get();
            return view('covid_19_lists', compact('patients'));
        }
    
}
