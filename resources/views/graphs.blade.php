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

</div>
@endsection
