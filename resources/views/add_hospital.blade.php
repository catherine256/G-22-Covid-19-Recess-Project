@extends('layouts.common')

@section('content')
<br><br>
<div style="color:black;">
<div class="pull-right">
  <a href="hospital" title="Go back"><button class="btn btn-success">Go Back</button> </a>
</div>
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-center">
                <h2 style="text-align:center">ADD A NEW GENERAL HOSPITAL</h2>
            </div>
        </div>
    </div>
@if(Session::has('national_hospital'))
   <span>{{Session::get('add_hospital')}}</span>
@endif
    <form action="{{route('add_hospital')}}" method="post" >
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" class="form-control" placeholder="name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Number of health officers:</strong>
                    <input type="number" name="number_of_health_officers" class="form-control" placeholder="number_of_health_officers">

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-dark">ADD GENERAL HOSPITAL</button>
            </div>
        </div>

    </form><br><br>

@endsection
