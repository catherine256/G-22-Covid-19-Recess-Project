@extends('layouts.app')

@section('content')
<br><br>
<div style="margin-left:10%; color:black">
<div class="pull-right">
  <a href="hospital" title="Go back"><button class="btn btn-success">Go Back</button> </a>
</div>
<h2 style="text-align:center;">EDIT HOSPITAL</h2>
@if(Session::has('hospital_update'))
   <span>{{Session::get('hospital_update')}}</span>
@endif
    <form method="post" action="{{route('update.hospital')}}">
    @csrf
    <div class="form-group">
    <input type="hidden" class="form-control" id="" name="hospital_id" value="{{$hospitals->hospital_id}}">
  </div>
    <div class="form-group">
    <label>Name:</label>
    <input type="text" class="form-control" id="" placeholder="name" name="name" value="{{$hospitals->name}}">
  </div>
  <div class="form-group">
    <label>category:</label>
    <input type="text" class="form-control" id="" placeholder="category" name="category" value="{{$hospitals->category}}">
  </div>
  <div class="form-group">
    <label>Number of health officers:</label>
    <input type="number" class="form-control" id="" placeholder="number_of_health_officers" name="number_of_health_officers" value="{{$hospitals->number_of_health_officers}}">
  </div>
  <div class="text-center"><button type="submit" class="btn btn-dark">Edit Hospital</button></div>
</form>
@endsection