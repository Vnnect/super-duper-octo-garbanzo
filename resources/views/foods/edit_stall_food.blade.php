<!-- edit.blade.php -->


@extends('vendor_login.layout')
@section('content')


@if (Session::has('message'))
   <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif



<div class="container">
<h2> <u>Edit Food Items </u></h2>
 {{-- <a href="{{url('stall_foods/create')}}" class="btn btn-primary" role="button">+ Add New Food Item</a><br><br>     --}}    

 
   <a href="{{ URL::to('downloadExcel/xls') }}"><button class="btn btn-success">Download Orders iin Excel xls</button></a>
        
        <a href="{{ URL::to('downloadExcel/csv') }}"><button class="btn btn-success">Download Orders in CSV</button></a>
        <br><br>

     <div class="top"></div>   
  <form method="post" action="{{action('FoodController@update', $id)}}" enctype="multipart/form-data">
    <div class="form-group row">
      {{csrf_field()}}
       <input name="_method" type="hidden" value="PATCH">
      <label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Food Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="title" name="name" value="{{$crud->name}}">
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
           <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-4 col-form-label col-form-label-sm">Foodcat Id</label>
       <div class="col-sm-8">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="title" name="foodcat_id" value="{{$crud->foodcat_id}}">
     {{--     <select name="court_id" class="form-control form-control-lg" id="lgFormGroupInput" name="foodcat_id"  >
         @foreach($foodcat as $food)
                <option value="{{ $food->id }}"> {{ $food->name }}</option>
             @endforeach
        </select> --}}
      </div>
    </div>
      </div>
       <div class="col-md-6">
          <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Unit Price</label>
       <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="title" name="unit_price" value="{{$crud->unit_price}}">
      </div>
    </div> 
      </div>

      <div class="col-md-6">
          <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-4 col-form-label col-form-label-sm">Avaliable days</label>
       <div class="col-sm-8">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="title" name="available_days" value="{{$crud->available_days}}">
      </div>
    </div>
      </div>

      <div class="col-md-6">
          <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Desc</label>
       <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="title" name="desc" value="{{$crud->desc}}">
      </div>
    </div>
      </div>

      <div class="col-md-6">
           <div class="form-group row">
      <label for="lgFormGroupInput" class="col-sm-4 col-form-label col-form-label-lg">Image</label>
       <div class="col-sm-10">
        <input type="file" name="img">
    </div> 
      </div>
      <div class="col-md-6">
          <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Active </label>
       <div class="col-sm-10">
         <input type="checkbox" name="active" checked><br>
      </div>
    </div> 
      </div>

    </div>
   
 
    
     
 
     <div class="form-group row">
      
       <div class="col-sm-10">
        <input type="hidden" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="title" name="stall_id" value="{{$crud->stall_id}}">
      </div>
    </div> 

    <div class="form-group row">
      <div class="col-md-2"></div>
      <button type="submit" class="btn btn-primary">Update</button>
    </div>
  </form>
</div>

@endsection