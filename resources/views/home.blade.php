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
    @if(Auth::user()->role === 'Director')
    <div class="w3-sidebar w3-teal" style="width:25% ; height:100%" >
      <ul class="list-unstyled">
        <li><h4><a href="covid_19_lists" class="w3-bar-item w3-button">LIST OF ENROLLED PATIENTS</a></h4></li>
        <li><h4><a href="home" class="w3-bar-item w3-button">COVID-19 HEALTH OFFICERS</a></h4>
            <ul>
                <li><h4><a href="healthofficerlists" class="w3-bar-item w3-button">GENERAL HEALTH OFFICERS</a></h4></li>
                <li><h4><a href="officersRegional" class="w3-bar-item w3-button">REGIONAL HEALTH OFFICERS</a></h4></li>
                <li><h4><a href="officersNational" class="w3-bar-item w3-button">NATIONAL HEALTH OFFICERS</a></h4></li>
                <li><h4><a href="" class="w3-bar-item w3-button">PENDING LIST OF  OFFICERS</a></h4></li>
            </ul>
        </li>
        <li><h4><a href="home" class="w3-bar-item w3-button">HOSPITALS</a></h4>
            <ul>
                <li><h4><a href="hospital" class="w3-bar-item w3-button">GENERAL HOSPITALS</a></h4></li>
                <li><h4><a href="regional_hospital" class="w3-bar-item w3-button">REGIONAL HOSPITALS</a></h4></li>
                <li><h4><a href="national_hospital" class="w3-bar-item w3-button">NATIONAL HOSPITALS</a></h4></li>
            </ul>
        </li> 
        <li><h4><a href="payments" class="w3-bar-item w3-button">PAYMENTS</a></h4></li> 
        <li><h4><a href="graphs" class="w3-bar-item w3-button">GRAPHS</a></h4></li>                               
        <li><h4><a href="hierarchy-charts" class="w3-bar-item w3-button">HIERARCHY CHARTS</a></h4></li>  
        <li><h4><a class="w3-bar-item w3-button" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }} </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf</form>
        </h4></li>  
      </ul>
    </div>                                                             
    @endif

    @if (Auth::user()->role === 'Administrator')
    <div class="w3-sidebar w3-teal" style="width:25% ; height:500px" >
      <ul class="list-unstyled">
        <li><h4><a href="registerhealthofficer" class="w3-bar-item w3-button">REGISTER HEALTH OFFICER</a></h4></li>                            
        <li><h4><a href="funds" class="w3-bar-item w3-button">REGISTER DONOR MONEY</a></h4></li>                              
        <li><h4><a href="covid_19_lists" class="w3-bar-item w3-button">LIST OF ENROLLED PATIENTS</a></h4></li>                                   
        <li><h4><a href="home" class="w3-bar-item w3-button">COVID-19 HEALTH OFFICERS</a></h4>
           <ul>
                <li><h4><a href="healthofficerlists" class="w3-bar-item w3-button">GENERAL HEALTH OFFICERS</a></h4></li>
                <li><h4><a href="officersRegional" class="w3-bar-item w3-button">REGIONAL HEALTH OFFICERS</a></h4></li>
                <li><h4><a href="officersNational" class="w3-bar-item w3-button">NATIONAL HEALTH OFFICERS</a></h4></li>
                <li><h4><a href="" class="w3-bar-item w3-button">PENDING LIST OF  OFFICERS</a></h4></li>
            </ul>
        </li> 
        <li><h4><a href="home" class="w3-bar-item w3-button">HOSPITALS</a></h4>
            <ul>
                <li><h4><a href="hospital" class="w3-bar-item w3-button">GENERAL HOSPITALS</a></h4></li>
                <li><h4><a href="regional_hospital" class="w3-bar-item w3-button">REGIONAL HOSPITALS</a></h4></li>
                <li><h4><a href="national_hospital" class="w3-bar-item w3-button">NATIONAL HOSPITALS</a></h4></li>
            </ul>
        </li>  
        <li><h4><a href="payments" class="w3-bar-item w3-button">PAYMENTS</a></h4></li>                             
        <li><h4><a href="graphs" class="w3-bar-item w3-button">GRAPHS</a></h4></li>                               
        <li><h4><a href="hierarchy-charts" class="w3-bar-item w3-button">HIERARCHY CHARTS</a></h4></li>   
                                    
      </ul>
    </div>
     @endif 

    

<div style="margin-left:27%;">
<i class='fas fa-briefcase-medical' style='font-size:100px;color:red; margin-left:30%'></i>
<div class="container" style="margin-left:20%; margin-top:5%;">POSITIVE CASES <br>
<button type="button" class="btn btn-dark btn-lg" style=" width:250px">0</button>
</div>
<div class="container" style="margin-left:20%; margin-top:10%;">FALSE POSITIVE CASES <br>
<button type="button" class="btn btn-dark btn-lg" style=" width:250px">0</button>
</div>
</div>
@endsection
