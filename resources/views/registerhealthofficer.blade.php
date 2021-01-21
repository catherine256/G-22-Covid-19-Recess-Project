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
     <li><h4><a href="registerhealthofficer" class="w3-bar-item w3-button"> REGISTER HEALTH OFFICER</a></h4></li>
     <li><h4><a href="healthofficerlists" class="w3-bar-item w3-button"> HEALTH OFFICER LISTS</a></h4></li>
     <li><h4><a href="covidcases" class="w3-bar-item w3-button"> COVID-19 CASES</a></h4></li>
     <li><h4><a href="funds" class="w3-bar-item w3-button"> FUNDS</a></h4>
        <ul>
           <li><h4><a href="funds" class="w3-bar-item w3-button"> REGISTER FUNDS</a></h4></li>
           <li><h4><a href="funds" class="w3-bar-item w3-button"> VIEW FUNDS</a></h4></li>
        </ul>
     </li>
     <li><h4><a href="payments" class="w3-bar-item w3-button"> PAYMENTS</a></h4></li>
     <li><h4><a href="graphs" class="w3-bar-item w3-button "> GRAPHS</a></h4></li>
   </ul>
</div>

<div style="margin-left:25%">
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-center">
                <h2>REGISTER A NEW COVID-19 HEALTH OFFICER</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="home" title="Go back"> <i class="fas fa-backward "></i> </a>
            </div>
        </div>
    </div>

    <!-- @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif -->
    <form action="" method="POST" >
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Username:</strong>
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
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>

@endsection
