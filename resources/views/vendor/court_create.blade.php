<!-- vendor_create.blade.php -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

@extends('master')
@section('content')

@if (Session::has('message'))
   <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif

<div class="container">
  <form method="post" action="{{url('new_court')}}" enctype="multipart/form-data">

                    <u><h1> New Court</h1></u><br><br>
                  
                       @include('errors.error')

  
    <div class="form-group row" id="myform">
      {{csrf_field()}}

          {{--  insertion for pg_venue table  --}}
          <label for="lgFormGroupInput" class="col-sm-2    col-form-label col-form-label-lg">Court Name</label>
          <div class="col-sm-10">
              <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Bay 1" name="name">
            </div>
          </div>

          <div class="row">

            <div class="col-md-6">

               <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-4 col-form-label col-form-label-sm">Location_Code</label>
          <div class="col-sm-8">
              <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="E101" name="location_code">
            </div>
          </div>
            </div>

            <div class="col-md-6">
            
               <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-4 col-form-label col-form-label-sm">TechPark Name</label>
          <div class="col-sm-8">
                  {{--  drop down menu for displaying all the names of address  --}}
                    <select name="venue_id" class="form-control form-control-lg" id="lgFormGroupInput>
                    @foreach($venue_details as $venues)
                    <option value="{{ $venues->id}}">{{ $venues->name }} - {{$venues->code}}</option>
                    @endforeach
                    </select>

          </div>
        </div>

            </div>

            <div class="col-md-6">
              <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-4 col-form-label col-form-label-sm">Landmark</label>
          <div class="col-sm-8">
              <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Near some place" name="land_mark">
            </div>
          </div>

            </div>

            <div class="col-md-6">
             <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-4 col-form-label col-form-label-sm">Location_map</label>
          <div class="col-sm-8">
              <input type="file" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="img" name="location_map">
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