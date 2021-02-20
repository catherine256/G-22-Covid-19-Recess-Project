@extends('layouts.common')

@section('content')
<br><br>
<div style="text-align:center">
    <div class="col-md-12 mt-3">
       <h4 style="color:red;"> PENDING COVID-19 HEALTH OFFICER LIST</h4>
    </div>

        @if (count($officers_pending))
        <table class="table table-bordered" style="background-color:white;">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Officer Name</th>
                <th scope="col">Officer Hospital</th>
                <th scope="col">Promoted</th>
                <th scope="col">Award</th>
                <th scope="col">Pending</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($officers_pending as $officer)
                <tr>
                    <th scope="row">{{ $officer->officer_name }}</th>
                    <td>{{ $officer->hospital_name }}</td>
                    <td>{{ $officer->upgrade }}</td>
                    <td><small>shs</small>{{  $officer->award }}</td>
                    <td>{{ $officer->pending }}</td>
                  </tr>
                @endforeach  
            </tbody>
          </table>
        @else
        <div class="mt-5">
            <h6>There is no pending officer yet</h6>
        </div>
        @endif

</div>


@endsection
