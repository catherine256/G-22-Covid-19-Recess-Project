@extends('layouts.app')

@section('content')
<br><br>
<div style="margin-left:10%; color:black">
<div class="pull-right">
  <a href="home" title="Go back"><button class="btn btn-success">Go Back</button> </a>
</div>
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-center">
                <h2 style="text-align:center">REGISTER A NEW COVID-19 HEALTH OFFICER</h2>
            </div>
        </div>
    </div>
@if(Session::has('officer_delete'))
   <span>{{Session::get('officer_delete')}}</span>
@endif
@if(Session::has('registerhealthofficer'))
   <span>{{Session::get('registerhealthofficer')}}</span>
@endif
@if(Session::has('status'))
   <span>{{Session::get('status')}}</span>
@endif
@if(Session::has('notFound'))
   <span>{{Session::get('notFound')}}</span>
@endif

    <form action="{{route('registerhealthofficer')}}" method="post" >
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

    </form><br><br>

@endsection
