@extends('layouts.common')

@section('content')
<br><br>
<div style="margin-top:0%;">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1 style="text-align:center">COVID-19 CASES LIST </h1> <br>
            </div>
            <!-- <div class="pull-right">
                <a class="btn btn-success" href="registerhealthofficer" title="register new officer"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div> -->
        </div>
    </div>
    <table class="table table-bordered" style="background-color:white;">
        <thead class="thead-dark">
            <tr>
                <th scope="col">PATIENT_ID</th>
                <th scope="col">PATIENT NAME</th>
                <th scope="col">GENDER</th>
                <th scope="col">STATUS</th>
                <th scope="col">OFFICER NAME</th>
                <th scope="col">HOSPITAL NAME</th>
                <th scope="col">DATE REGISTERED</th>
            </tr>
        </thead> 
                @foreach ($patients as $patient)
                    <tr>
                        <td>{{ $patient->id }}</td>
                        <td>{{ $patient->patient_name }}</td>
                        <td>{{ $patient->gender }}</td>
                        <td>{{ $patient->category }}</td>
                        <td>{{ $patient->officer_name }}</td>
                        <td>{{ $patient->hospital_name }}</td>
                        <td>{{$patient->date_registered}}</td>
                      </tr>
                @endforeach  
    
    </table>
</div>
@endsection