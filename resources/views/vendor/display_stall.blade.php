{{--  Display all the Stalls  --}}

@extends('master')
@section('content')


<a href="http://www.scapikgo.dev/new_stall" class="btn btn-primary" role="button" >+ ADD NEW </a>
<div class="container">
  <h2>REGISTRED VENDORS</h2>         

  

  <table class="table table-hover">
    <thead>
      <tr>
        <th>Id</th>
        <th>stall_no</th>
        <th>court_id</th>
        <th>working_hours</th>
        <th>todays_special</th>
        <th>Action</th>
      </tr>
    </thead>

        @foreach($stall_list as $stalls)
            
            <tbody>

            <tr>
                <td>{{ $stalls->id }}</td>
                <td>{{ $stalls->stall_no }}</td>
                <td>{{ $stalls->court_id}}</td>
                <td>{{ $stalls->working_hours}}</td>
                <td>{{ $stalls->todays_special }}</td>
                <td> 
                  <a href="/stall_edit/{{$stalls->id}}" class="button">Edit</a> 
                  &nbsp;
                  <a href="/stall_delete/{{$stalls->id}}" class="button">Delete</a>
                 </td>
            </tr>
            
            </tbody>

        @endforeach
  </table>
</div>
@endsection('content')