<!-- vendor_create.blade.php -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

@extends('master')
@section('content')


@if (Session::has('message'))
   <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif

<div class="container">
  <form method="post" action="{{url('new_venue')}}" enctype="multipart/form-data">

                    <u><h1> New Venue</h1></u><br><br>
  
     @include('errors.error')

    <div class="form-group row" id="myform">
      {{csrf_field()}}

          {{--  insertion for pg_venue table  --}}
          <label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">TechPark Name</label>
          <div class="col-sm-10">
              <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder=" infosys" name="name">
            </div>
          </div>

        <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">TechParkCode</label>
          <div class="col-sm-10">
              <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Eg: INFO" name="code">
            </div>
          </div>



      

        <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Address</label>
          <div class="col-sm-10">
                  {{--  drop down menu for displaying all the names of address  --}}
                    <select name="address_id" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Address ID fk">
                    @foreach($address_drop as $address)
                    <option value="{{ $address->id }}">{{ $address->landmark }}, {{$address->street}}, {{ $address->addressline1 }} -  {{$address->pincode}}</option>
                    @endforeach
                    </select>
          </div>

        </div>

    

           <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">TechPark Image</label>
          <div class="col-sm-10">
               <input type="file" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="img" name="img">
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