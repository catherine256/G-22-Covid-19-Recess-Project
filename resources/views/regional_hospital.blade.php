@extends('layouts.common')

@section('content')
<br><br>
<div style="color:black;">
@if (Auth::user()->role === 'Administrator')
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-center">
                <h2 style="text-align:center">ADD A NEW GENERAL HOSPITAL</h2>
            </div>
        </div>
    </div>
@if(Session::has('add_regional'))
   <span>{{Session::get('add_regional')}}</span>
@endif
    <form action="{{route('regional_hospital')}}" method="post" >
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
                <button type="submit" class="btn btn-primary">ADD REGIONAL HOSPITAL</button>
            </div>
        </div>

    </form>
    @endif
    <br><br>
    <h2 style="text-align:center">REGIONAL HOSPITALS LIST</h2>

    <table class="table table-bordered" style="background-color:white">
  <thead class="thead-dark">
    <tr>
      <th scope="col">HOSPITAL_ID</th>
      <th scope="col">HOSPITAL_NAME</th>
      <th scope="col">CATEGORY</th>
      <th scope="col">NUMBER OF HEALTH OFFICERS</th>
      <th scope="col">DATE_REGISTERED</th>

    </tr>
    @foreach($regionals as $regional)
        <tr>
             <td>{{$regional->hospital_id}}</td>
             <td>{{$regional->name}}</td>
             <td>{{$regional->category}}</td>
             <td>{{$regional->number_of_health_officers}}</td>
             <td>{{$regional->date}}</td>
          </tr>
        @endforeach
  </thead>
</table>



@endsection

