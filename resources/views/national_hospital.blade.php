@extends('layouts.common')

@section('content')
<br><br>
<div style="color:black;">
@if (Auth::user()->role === 'Administrator')
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-center">
                <h2 style="text-align:center">ADD A NEW NATIONAL HOSPITAL</h2>
            </div>
        </div>
    </div>
@if(Session::has('add_national'))
   <span>{{Session::get('add_national')}}</span>
@endif
    <form action="{{route('national_hospital')}}" method="post" >
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
                <button type="submit" class="btn btn-dark">ADD NATIONAL HOSPITAL</button>
            </div>
        </div>

    </form>
    @endif
    <br><br><br>

    <h2 style="text-align:center">NATIONAL HOSPITALS LIST</h2>

    <table class="table table-bordered" style="background-color:white">
  <thead class="thead-dark">
    <tr>
      <th scope="col">HOSPITAL_ID</th>
      <th scope="col">HOSPITAL_NAME</th>
      <th scope="col">CATEGORY</th>
      <th scope="col">NUMBER OF HEALTH OFFICERS</th>
      <th scope="col">DATE_REGISTERED</th>
    </tr>
    @foreach($nationals as $national)
        <tr>
             <td>{{$national->hospital_id}}</td>
             <td>{{$national->name}}</td>
             <td>{{$national->category}}</td>
             <td>{{$national->number_of_health_officers}}</td>
             <td>{{$national->date}}</td>
          </tr>
        @endforeach
  </thead>
</table>



@endsection
