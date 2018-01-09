<!-- create.blade.php -->

@extends('food_master')
@section('content')
  @include('errors.error')

@if (Session::has('message'))
   <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif

<div class="container">
  <form method="post" action="{{action('FoodController@store')}}" enctype="multipart/form-data">
    <div class="form-group row">
      {{csrf_field()}}

      <label  class="col-sm-2 col-form-label col-form-label-lg">Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" placeholder="Name" name="name">
      </div>

       <label  class="col-sm-2 col-form-label col-form-label-lg">Food_cat_id</label>
       <div class="col-sm-10">
         <select name="foodcat_id" class="form-control form-control-lg"   >
         @foreach($foodcat as $food)
                <option value="{{$food->id }}"> {{ $food->name }}</option>
             @endforeach
        </select>
      </div> 

       <label  class="col-sm-2 col-form-label col-form-label-lg">Stall Id</label>
       <div class="col-sm-10">
        <input type="number" class="form-control form-control-lg"  placeholder="stall number" name="stall_id" value="{{$stall_id_print}}">
      </div> 

       <label  class="col-sm-2 col-form-label col-form-label-lg">unit_price</label> <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" placeholder="unit_price" name="unit_price">
      </div> 

       <label  class="col-sm-2 col-form-label col-form-label-lg">avalibale_days</label><div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" placeholder="available_days" name="available_days">
      </div>  

      <label  class="col-sm-2 col-form-label col-form-label-lg">desc</label><div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" placeholder="desc" name="desc">
      </div>
    </div>


    <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Active </label>
       <div class="col-sm-10">
         <input type="checkbox" name="active" checked><br>
      </div>
    </div> 


     <label  class="col-sm-2 col-form-label col-form-label-lg">Image</label>
       <div class="col-sm-10">
        <input type="file" class="form-control form-control-lg"  name="img">
      </div>
    </div>
    </div>

     <br><br>
    
    </div>
    <div class="form-group row">
      <div class="col-md-2"></div>
      <input type="submit" class="btn btn-primary">
    </div>
  </form>
</div>
@endsection