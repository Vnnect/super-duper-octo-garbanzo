  {{--  vendor stall_create blade file  --}}

{{-- <div class="container">
  <a href="{{url('display_stall')}}" class="btn btn-primary top_btn" role="button" >  Display Stall </a>
</div> --}}
@extends('master')
@section('content')


@if (Session::has('message'))
   <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif


<div class="container">
  <form method="post" action="{{url('new_stall')}}" enctype="multipart/form-data">

                    <u><h1> New Stall</h1></u> <br><br>
  
     @include('errors.error')


    <div class="form-group row" id="myform">
      {{csrf_field()}}

          {{--  insertion for pg_vendor table  --}}
          <label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Stall Name or Number</label>
          <div class="col-sm-10">
              <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Eg: Stall 01 KFC" name="stall_no">
            </div>
          </div>

        <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Court Name</label>
          <div class="col-sm-10">


            <select name="court_id" class="form-control form-control-lg" id="lgFormGroupInput" >
             @foreach($court_dropper as $court)
                <option value="{{ $court->id }}"> {{ $court->name }} - {{$court->land_mark}}</option>
             @endforeach
            </select>
    
            </div>
          </div>

        <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Vendor Name</label>
          <div class="col-sm-10">
          <select name="vendor_id" class="form-control form-control-lg" id="lgFormGroupInput" >
             @foreach($vendor_dropper as $vendor)
                <option value="{{ $vendor->id }}"> {{ $vendor->name }} - {{$vendor->phone_no}}</option>
             @endforeach
            </select>
          </div>
          </div>

          <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Stall Image</label>
          <div class="col-sm-10">
              <input type="file" class="form-control form-control-lg" id="lgFormGroupInput"  name="img">
            </div>
          </div>
           
      
         {{--  <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm ">Opened Today</label> --}}
          
        
            <input type="hidden" name="open_today" checked value="0"><br>
        
            {{--  <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" name="open_today">  --}}
       
        
        
         {{--  <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Working Days</label> --}}
         
            <input type="hidden" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Eg: MON-SAT" name="working_days" value="MON-SAT">
      
       
        
            
       
         {{--  <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Working Hours</label> --}}
   
            <input type="hidden" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="9AM-6PM" name="working_hours" value="9AM - 6PM">

        

     
          {{-- <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Todays Special</label> --}}
    
            <input type="hidden" class="form-control form-control-lg" id="lgFormGroupInput"  name="todays_special" value="-">
         
       
        
         

          {{--  drop down menu for displaying all the names of venue  --}}
     {{--  <select name="address_id" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Address ID fk">
      @foreach($drop as $droper)
      <option value="{{ $droper->address_id }}">{{ $droper->name }}</option>
      @endforeach
    </select>  --}}  



      {{--  submit button   --}}
    <div class="form-group row">
      <div class="col-md-2"></div>
      <input type="submit" class="btn btn-success sub">
    </div>


  </form>
</div>
@endsection('content')