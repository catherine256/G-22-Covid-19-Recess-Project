@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            </div>
        </div>
    </div>
</div>
<div class="w3-sidebar w3-bar-block" style="width:15%;" >
   <ul class="list-unstyled">
     <li><h4><a href="registerhealthofficer" class="w3-bar-item w3-button "> REGISTER HEALTH OFFICER</a></h4></li>
     <li><h4><a href="healthofficerlists" class="w3-bar-item w3-button "> HEALTH OFFICER LISTS</a></h4></li>
     <li><h4><a href="covid19cases" class="w3-bar-item w3-button "> COVID-19 CASES</a></h4></li>
     <li><h4><a href="funds" class="w3-bar-item w3-button "> FUNDS</a></h4>
        <ul>
           <li><h4><a href="funds" class="w3-bar-item w3-button"> REGISTER FUNDS</a></h4></li>
           <li><h4><a href="funds" class="w3-bar-item w3-button"> VIEW FUNDS</a></h4></li>
        </ul>
     </li>
     <li><h4><a href="payments" class="w3-bar-item w3-button "> PAYMENTS</a></h4></li>
     <li><h4><a href="graphs" class="w3-bar-item w3-button "> GRAPHS</a></h4></li>
   </ul>
</div>

<div style="margin-left:25%">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1 style="text-align:center">COVID-19 HEALTH OFFICER </h1> <br>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="registerhealthofficer" title="register new officer"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div>
        </div>
    </div>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">USERNAME</th>
                <th scope="col">EMAIL</th>
                <th scope="col">DISTRICT</th>
                <th scope="col">POSITION</th>
                <th scope="col">DaTE REGISTERED</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
    
    </table>
</div>
@endsection
