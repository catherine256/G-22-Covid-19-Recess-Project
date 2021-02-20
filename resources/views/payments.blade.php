@extends('layouts.common')

@section('content')
<br>
<style>
    span.invalid-feedback{
        text-align: center !important;
    }
    .invalid{
        color:red !important;
    }

</style>
<div>
    <div class="container mt-4">
   
  <form method="POST" action="payments" class="m-2">
    @csrf

    <div class="form-group">
      <div class="form-group">
        <label for="role" class="label">{{ __('SELECT DATE') }}</label>
        <div class="col-md-12">
            <select name="month" id="" class="form-control">
              @if (count($months))
              @foreach ($months as $month)
              <option value={{ $month->date_declared }}>{{ $month->date_declared }}</option>
              @endforeach
              @endif
              

            </select><br>
            
            @error('role')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
    </div>
    <div class="form-group">
            <button type="submit" class="btn btn-secondary">
                {{ __('Select Date') }}
            </button>
        
    </div>
</form> 
        <div class="row justify-content-center">
            <div class="col-md-12 m-3">
                <h1 style="color:black; text-align:center">Money Distribution on {{ $month->date_declared }}
                </h1>
            </div>
            <div class="col-md-12 mt-3">
                <h5>Money Distribution To Staff Members</h5>
            </div>
            @if (count($staff_payments))
            <table class="table table-bordered" style="background-color:white;">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Staff Member Name</th>
                    <th scope="col">Position</th>
                    <th scope="col">Salary</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($staff_payments as $payment)
                    <tr>
                        <th scope="row">{{ $payment->name }}</th>
                        <td>{{ $payment->role }}</td>
                        <td> <small>shs</small>{{  $payment->monthly_allowance }}</td>
                      </tr>
                    @endforeach  
                </tbody>
              </table>
            
            @else
            <div class="mt-5">
                <h6>There was no payements this month</h6>
            </div>
            @endif

            <div class="col-md-12 mt-3">
                <h2 style="text-align:center">Money Distribution To Health Officers</h2>
            </div>

            <div class="col-md-12 mt-3">
                <h5>Health Officers At General Hospitals</h5>
            </div>
            @if (count($officers_at_general))
            <table class="table table-bordered" style="background-color:white;">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Officer Name</th>
                    <th scope="col">Position</th>
                    <th scope="col">Salary</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($officers_at_general as $payment)
                    <tr>
                        <th scope="row">{{ $payment->name }}</th>
                        <td>{{ $payment->position }}</td>
                        <td> <small>shs</small>{{  $payment->monthly_allowance }}</td>
                      </tr>
                    @endforeach  
                </tbody>
              </table>
            @else
            <div class="mt-5">
                <h6>There was no payements made for general officers this month</h6>
            </div>
            @endif
            <div class="col-md-12 mt-3">
                <h5>Health Officers At Regional Hospitals</h5>
            </div>
            @if (count($officers_at_referal))
            <table class="table table-bordered" style="background-color:white;">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Officer Name</th>
                    <th scope="col">Position</th>
                    <th scope="col">Salary</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($officers_at_referal as $payment)
                    <tr>
                        <th scope="row">{{ $payment->name }}</th>
                        <td>{{ $payment->position }}</td>
                        <td> <small>shs</small>{{  $payment->monthly_allowance }}</td>
                      </tr>
                    @endforeach  
                </tbody>
              </table>
            @else
            <div class="mt-5">
                <h6>There was no payements made for  officers in Regional Hospitals this month</h6>
            </div>
            @endif


            <div class="col-md-12 mt-3">
                <h5 class="tab">Health Officers At National Hospitals</h5>
            </div>
            @if (count($officers_at_national))
            <table class="table table-bordered" style="background-color:white;">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Officer Name</th>
                    <th scope="col">Position</th>
                    <th scope="col">Salary</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($officers_at_national as $payment)
                    <tr>
                        <th scope="row">{{ $payment->name }}</th>
                        <td>{{ $payment->position }}</td>
                        <td> <small>shs</small>{{  $payment->monthly_allowance }}</td>
                      </tr>
                    @endforeach  
                </tbody>
              </table>
            @else
            <div class="mt-5">
                <h6>There was no payements made for  officers in National Hospitals this month</h6>
            </div>
            @endif

           

            

            
        </div>
    </div>
</div>

@endsection