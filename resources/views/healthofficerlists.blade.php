@extends('layouts.app')

@section('content')
<br><br>
<div style="">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1 style="text-align:center">COVID-19 HEALTH OFFICER LIST </h1> <br>
            </div>
        </div>
    </div>
    <table class="table table-bordered" style="background-color:white">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NAME</th>
                <th scope="col">USERNAME</th>
                <th scope="col">EMAIL</th>
                <th scope="col">DISTRICT</th>
                <th scope="col">POSITION</th>
                <th scope="col">NUMBER OF PATIENTS TREATED</th>
                <th scope="col">HOSPITAL NAME</th>
                <th scope="col">DATE REGISTERED</th>
                <th width="280px">Action</th>
            </tr>
        @foreach($officers as $officer)
        <tr>
             <td>{{$officer->id}}</td>
             <td>{{$officer->name}}</td>
             <td>{{$officer->username}}</td>
             <td>{{$officer->email}}</td>
             <td>{{$officer->district}}</td>
             <td>{{$officer->position}}</td>
             <td>{{$officer->number_of_patients_treated}}</td>
             <td>{{$officer->hospital_name}}</td>
             <td>{{$officer->date_registered}}</td> 
             <td>
            @if (Auth::user()->role === 'Administrator')
                <a href="/edit_officer/{{$officer->id}}"><button class="btn btn-primary">Edit</button></a> | 
                <a href="/delete_officer/{{$officer->id}}"><button class="btn btn-danger">Delete</button></a>
            @endif

             </td>
          </tr>
        @endforeach
        </thead>
    
    </table><br>
    @if (Auth::user()->role === 'Administrator')
        <div class="pull-right">
           <a href="registerhealthofficer" title="Add hospital"><button class="btn btn-light">Add health officer</button> </a>
        </div>
    @endif
</div>
@endsection
