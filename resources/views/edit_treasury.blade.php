@extends('layouts.app')

@section('content')
<br><br>
<div style="margin-left:10%">
<div class="pull-right">
  <a href="/funds" title="Go back"><button class="btn btn-success">Go Back</button> </a>
</div>
<h2 style="text-align:center;">Edit the Treasury</h2>
@if(Session::has('treasury_update'))
   <span>{{Session::get('treasury_update')}}</span>
@endif
    <form method="post" action="{{route('update.treasury')}}">
    @csrf
    <div class="form-group">
    <input type="hidden" class="form-control" id="" name="treasury_id" value="{{$treasury->treasury_id}}">
  </div>
    <div class="form-group">
    <label>AMOUNT</label>
    <input type="number" class="form-control" id="" placeholder="amount" name="amount" value="{{$treasury->amount}}">
  </div>
  <div class="form-group">
    <label>DONOR</label>
    <input type="text" class="form-control" id="" placeholder="donor" name="donor" value="{{$treasury->donor}}">
  </div>
  <div class="text-center"><button type="submit" class="btn btn-primary">Edit</button></div>
</form>
@endsection