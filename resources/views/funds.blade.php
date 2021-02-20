@extends('layouts.common')

@section('content')
<br><br>
<div style="">
@if(Session::has('treasury_delete'))
   <span>{{Session::get('treasury_delete')}}</span>
@endif
<h2 style="text-align:center;">DECLARE AND REGISTER DONOR FUNDS</h2>
@if(Session::has('funds'))
   <span>{{Session::get('funds')}}</span>
@endif
    <form method="post" action="{{route('funds')}}">
    @csrf
    <div class="form-group">
    <label  style="color:white">AMOUNT</label>
    <input type="number" class="form-control" id="" placeholder="amount" name="amount">
  </div>
  <div class="form-group">
    <label  style="color:white">DONOR</label>
    <input type="text" class="form-control" id="" placeholder="donor" name="donor">
  </div>
  <div class="text-center"><button type="submit" class="btn btn-dark">Register Funds</button></div>
</form><br><br><br>
   <h2 style="text-align:center;">TREASURY STATUS</h2>
   <table class="table table-bordered" style="background-color:white">
      <thead class="thead-dark">
          <tr>
             <th scope="col">TREASURY_ID</th>
             <th scope="col">AMOUNT</th>
             <th scope="col">DATE</th>
             <th scope="col">DONOR</th>
             <th scope="col">ACTION</th>
          </tr>
          @foreach($treasury as $treasurys)
          <tr>
             <td>{{$treasurys->treasury_id}}</td>
             <td>{{$treasurys->amount}}</td>
             <td>{{$treasurys->date_declared}}</td>
             <td>{{$treasurys->donor}}</td>
             <td>
                <a href="/edit_treasury/{{$treasurys->treasury_id}}"><button class="btn btn-primary">Edit</button></a> | 
                <a href="/delete_treasury/{{$treasurys->treasury_id}}"><button class="btn btn-danger">Delete</button></a>
             </td>
          </tr>
          @endforeach
       </thead>
   </table>
</div>

@endsection
