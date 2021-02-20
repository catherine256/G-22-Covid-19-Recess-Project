@extends('layouts.common')

@section('content')
<br><br>
<div style="">
<div class="pull-right">
  <a href="/healthofficerlists" title="Go back"><button class="btn btn-success">Go Back to the list</button> </a>
</div>
<h2 style="text-align:center;">Edit the Officer</h2>
@if(Session::has('officer_update'))
   <span>{{Session::get('officer_update')}}</span>
@endif
    <form method="post" action="{{route('update.officer')}}" style="color:black">
    @csrf
    <div class="form-group">
    <input type="hidden" class="form-control" id="" name="id" value="{{$officers->id}}">
  </div>
    <div class="form-group">
    <label  style="color:white">Name:</label>
    <input type="text" class="form-control" id="" placeholder="full name" name="name" value="{{$officers->name}}">
  </div>
  <div class="form-group">
    <label  style="color:white">Username:</label>
    <input type="text" class="form-control" id="" placeholder="username" name="username" value="{{$officers->username}}">
  </div>
  <div class="form-group">
    <label  style="color:white">Email:</label>
    <input type="email" class="form-control" id="" placeholder="email" name="email" value="{{$officers->email}}">
  </div>
  <div class="form-group">
    <label  style="color:white">District:</label>
    <input type="text" class="form-control" id="" placeholder="district" name="district" value="{{$officers->district}}">
  </div>
  <div class="form-group">
    <label  style="color:white">Postion:</label>
    <input type="text" class="form-control" id="" placeholder="position" name="position" value="{{$officers->position}}">
  </div>
  <div class="form-group">
    <label  style="color:white">Number of patients treated:</label>
    <input type="number" class="form-control" id="" placeholder="number_of_patients_treated" name="number_of_patients_treated" value="{{$officers->number_of_patients_treated}}">
  </div>
  <div class="form-group">
    <label  style="color:white">Hospital Name:</label>
    <input type="text" class="form-control" id="" placeholder="hospital_name" name="hospital_name" value="{{$officers->hospital_name}}">
  </div>
  <div class="text-center"><button type="submit" class="btn btn-primary">Edit</button></div>
</form>
@endsection