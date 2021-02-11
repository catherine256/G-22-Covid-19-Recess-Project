@extends('layouts.common')

@section('content')
<br><br>
<div style="" >
  <h4 style="text-align:center;color:white"> GENERAL HOSPITALS LIST </h4>
  
  <table class="table table-bordered" style="background-color:white">
  <thead class="thead-dark">
    <tr>
      <th scope="col">HOSPITAL_ID</th>
      <th scope="col">HOSPITAL_NAME</th>
      <th scope="col">CATEGORY</th>
      <th scope="col">NUMBER OF HEALTH OFFICERS</th>
      <th scope="col">DATE_REGISTERED</th>
      <th scope="col">ACTION<th>
    </tr>
    @foreach($hospitals as $hospital)
        <tr>
             <td>{{$hospital->hospital_id}}</td>
             <td>{{$hospital->name}}</td>
             <td>{{$hospital->category}}</td>
             <td>{{$hospital->number_of_health_officers}}</td>
             <td>{{$hospital->date}}</td>
             <td>
             @if (Auth::user()->role === 'Administrator')
                <a href="/edit_hospital/{{$hospital->hospital_id}}"><button class="btn btn-primary">Edit</button></a> | 
                <a href="/delete_hospital/{{$hospital->hospital_id}}"><button class="btn btn-danger">Delete</button></a>
              @endif
             </td>
          </tr>
        @endforeach
  </thead>
</table>
@if (Auth::user()->role === 'Administrator')
<div class="pull-right">
  <a href="add_hospital" title="Add hospital"><button class="btn btn-light">Add General Hospital</button> </a>
</div>
@endif
<br><br><br>


</div>

@endsection
