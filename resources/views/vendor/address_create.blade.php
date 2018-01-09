<!-- Address_create.blade.php -->


@extends('master')
@section('content')
<div class="container">
  <form method="post" action="{{url('new_address')}}">

                    <u><h1> New Address</h1></u><br><br>
 {{--  session front end errors will be stored in error --}}
   @include('errors.error')



 @if (Session::has('message'))
   <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif


    <div class="form-group row">
      {{csrf_field()}}

      {{--  insertion for addresss table  --}}

      <label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Street</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Street name" name="street">
      </div>
    </div>

    <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Addressline1</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Address line 1" name="addressline1">
      </div>
    </div>

    <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Addressline2</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Address line two" name="addressline2">
      </div>
    </div>

    <div class="row">
    <div class="col-md-6">
        <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-4 col-form-label col-form-label-sm">Pincode</label>
      <div class="col-sm-8">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Pincode" name="pincode">
      </div>
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Landmark</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="landmark" name="landmark">
      </div>
    </div>
    </div>


    </div>

    <div class="row">

    <div class="col-md-4">
        <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-6 col-form-label col-form-label-sm">City</label>
      <div class="col-sm-6">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="City Name" name="city">
      </div>
    </div>
    </div>
    
    <div class="col-md-4">
        <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">State</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="State" name="state">
      </div>
    </div>


    </div>

    <div class="col-md-4">
      <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Country</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Country" name="country">
      </div>
    </div>
    

    </div>


    </div>

    
    
    
    
    
    



      {{--  submit button   --}}
    <div class="form-group row">
      <div class="col-md-2"></div>
      <input type="submit" class="btn btn-success sub">
    </div>


  </form>


</div>

@endsection