
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
{{--  Display all the vendors  --}}
@extends('vendor_login.auth.admin_layout')

@section('content')

<div class="container">
<a href="{{url('new_address')}}" class="btn btn-primary" role="button" >+ ADD NEW </a>
<br>
</div>

@if (Session::has('message'))
   <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif

<div class="container mar_left">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
    <u><h1> Registered Vendors</h1></u> <br>
  
  

  <table class="table table-hover">
    <thead>
      <tr>
        <th>Id</th>
        <th>Account Number</th>
        <th>Bank Name</th>
        <th>Account_Type</th>
        <th>Vendor Name</th>
        <th>Code</th>
        <th>Active</th>
        {{-- <th>verified</th> --}}
        <th>Verified_date</th>
        <th>Pancard </th>
        <th>Contact Name</th>
        <th>Contact Email</th>
        <th> Action </th>
        
      </tr>
    </thead>

        @foreach($data as $vendor)
            
            <tbody>

            <tr>
                <td>{{ $vendor->id }}</td>
                <td>{{ $vendor->bank_account_no }}</td>
                <td>{{ $vendor->bank_account_name}}</td>
                <td>{{ $vendor->account_type}}</td>
                <td>{{ $vendor->name }}</td>
                <td>{{ $vendor->code }}</td>
                <td>{{ $vendor->active}}</td>
                {{-- <td>{{ $vendor->verified }}</td> --}}
                <td>{{ $vendor->verified_date }}</td>
                <td>{{ $vendor->pancard_no }}</td>
                <td>{{ $vendor->contact_person }}</td>
                <td>{{ $vendor->contact_email }}</td>
                <td> 
                  <a href="/vendor_edit/{{$vendor->id}}" class="button"><i class="icons fa fa-pencil-square-o"></i></a> 
                  &nbsp;
                  <a href="/vendor_delete/{{$vendor->id}}" class="button"><i class="icons fa fa-trash-o"></i></a>
                 </td>
                
            </tr>
            
            </tbody>

        @endforeach
  </table>
</div>
</div>
</div>
@endsection('content')