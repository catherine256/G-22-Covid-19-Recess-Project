@extends('layouts.app')

@section('content')
<br><br>
<div style="margin-left:10%; color:white">
<div class="pull-right">
  <a href="home" title="Go back"><button class="btn btn-success">Go Back</button> </a>
</div>
@if (Auth::user()->role === 'Administrator')
   <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-center">
                <h3 style="text-align:center">REGISTER A NEW COVID-19 HEALTH OFFICER AT A REGIONAL HOSPITAL</h3>
            </div>
        </div>
    </div>
 @if(Session::has('status'))
   <span>{{Session::get('status')}}</span>
  @endif
  @if(Session::has('notFound'))
   <span>{{Session::get('notFound')}}</span>
  @endif

    <form action="{{route('officersRegional')}}" method="post" >
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Full name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>username:</strong>
                    <input type="text" name="username" class="form-control" placeholder="username">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="email" name="email" class="form-control" placeholder="email">

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>District:</strong>
                    <input type="text" name="district" class="form-control" placeholder="district">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Position:</strong>
                    <input type="text" name="position" class="form-control" placeholder="position">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Number of health officers:</strong>
                    <input type="number" name="number_of_patients_treated" class="form-control" placeholder="number_of_patients_treated">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-dark">REGISTER</button>
            </div>
        </div>

    </form>
@endif
<br><br>
    <h3 style="text-align:center">COVID-19 HEALTH OFFICER LIST </h3>     

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
            </tr>
        @foreach($officersRegional as $officersRegionals)
        <tr>
             <td>{{$officersRegionals->id}}</td>
             <td>{{$officersRegionals->name}}</td>
             <td>{{$officersRegionals->username}}</td>
             <td>{{$officersRegionals->email}}</td>
             <td>{{$officersRegionals->district}}</td>
             <td>{{$officersRegionals->position}}</td>
             <td>{{$officersRegionals->number_of_patients_treated}}</td>
             <td>{{$officersRegionals->hospital_name}}</td>
             <td>{{$officersRegionals->date_registered}}</td> 
          </tr>
        @endforeach
        </thead>
    
    </table>
</div>
</div>

@endsection
