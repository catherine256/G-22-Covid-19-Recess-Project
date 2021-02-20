@extends('layouts.common')

@section('content')
<br><br>
<div class="pull-right">
  <a href="home" title="Go back"><button class="btn btn-light">Go Back Home</button> </a>
</div>
<br><br>
<div style="text-align:center">
    <div class="col-md-12 mt-3">
       <h4 style="color:white;">NATIONAL COVID-19 HEALTH OFFICER LIST</h4>
    </div>

        @if (count($officers_national))
        <table class="table table-bordered" style="background-color:white;">
            <thead class="thead-dark">
              <tr>
                <th scope="col">OFFICER_ID</th>
                <th scope="col">NAME</th>
                <th scope="col">USERNAME</th>
                <th scope="col">EMAIL</th>
                <th scope="col">DISTRICT</th>
                <th scope="col">POSITION</th>
                <th scope="col">NUMBER OF PATIENTS TREATED</th>
                <th scope="col">HOSPITAL Name</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($officers_national as $officer)
                <tr>
                    <td>{{ $officer->id }}</td>
                    <td>{{ $officer->name }}</td>
                    <td>{{ $officer->username }}</td>>
                    <td>{{ $officer->email}}</td>
                    <td>{{ $officer->district}}</td>
                    <td>{{ $officer->position}}</td>
                    <td>{{ $officer->number_of_patients_treated}}</td>
                    <td>{{ $officer->hospital_name}}</td>
                  </tr>
                @endforeach  
            </tbody>
          </table>
        @else
        <div class="mt-5">
            <h6 style="color:red;">There is no  officers in the national hospitals yet</h6>
        </div>
        @endif

</div>


@endsection
