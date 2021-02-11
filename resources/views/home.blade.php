@extends('layouts.common')

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
<div style="margin-left:25%;">
<i class='fas fa-briefcase-medical' style='font-size:100px;color:red; margin-left:30%'></i>
<div class="container" style="margin-left:20%; margin-top:5%;"> TOTAL NUMBER OF CASES <br>
<button type="button" class="btn btn-dark btn-lg" style=" width:250px">{{count($patients_total)}}</button>
</div>
<div class="container" style="margin-left:20%; margin-top:10%;">GENERAL TOTAL HEALTH OFFICERS <br>
<button type="button" class="btn btn-dark btn-lg" style=" width:250px">{{count($officers_total)}}</button>
</div>

</div>


@endsection
