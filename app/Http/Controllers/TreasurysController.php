<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TreasurysController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addTreasury()
    {
        return view('funds');
    }

    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function treasuryList()
    {
        $treasury = DB::table('treasury')->get();
        return view('funds', compact('treasury'));
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveTreasury(Request $request)
    {
        DB::table('treasury')->insert([
            'amount'=>$request->amount,
            // 'date_declared'=>$request->date_declared,
            'donor'=>$request->donor

        ]);
        return back()->with('funds', 'Treasury registered successfully');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function editTreasury($treasury_id)
    {
        $treasury = DB::table('treasury')->where('treasury_id', $treasury_id)->first();
        return view('edit_treasury', compact('treasury'));
    }

    // /*
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function updateTreasury(Request $request)
    {
        DB::table('treasury')->where('treasury_id', $request->treasury_id)->update([
            'amount'=>$request->amount,
            // 'date_declared'=>$request->date_declared,
            'donor'=>$request->donor

        ]);
        return back()->with('treasury_update', 'Treasury updated successfully');
    }

    // /*
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function deleteTreasury($treasury_id)
    {
        DB::table('treasury')->where('treasury_id', $treasury_id)->delete();
        return back()->with('treasury_delete', 'Treasury Deleted successfully');
    }

    public function showGraph()
    {
        $treasury = DB::table('treasury')->get();
       return view('graphs',['treasury' => $treasury]);   
    }
}
