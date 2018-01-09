<!-- index.blade.php -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
@extends('vendor_login.layout')

@if (Session::has('message'))
   <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

{{-- food delete --}}
@if (Session::has('delete_message'))
   <div class="alert alert-danger">{{ Session::get('delete_message') }}</div>
@endif


@section('content')

        <div class="container">
         <h2><u>Vendor Stall Manager</u></h2>
     <form method="POST" action="{{ url('/downloadExcel') }}">

          <input type="hidden" name="data" value="xls">
          <input type="hidden" name="stall_id_print" value="{{$main_stall_id}}">
       {{-- <a href="{{url('stall_foods/create')}}" class="btn btn-primary" role="button">+ Add New Food Item</a><br><br>         --}}
         <button class="btn btn-success" type="submit"> Download Order History in Excel xls</button>
          
       </form>

       <form method="POST" action="{{ url('/stall_foods_id') }}">

          <input type="hidden" name="stall_id_print" value="{{$main_stall_id}}">        
         <button class="btn btn-primary" type="submit"> + Add New Food Item</button>
          
       </form>
        
   
        <br><br>

  
    <table class="table table-striped">
    <thead>
      <tr>
        <b>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>desc</th>
        <th>Active</th>
        <th>Image</th>

        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($cruds as $post)
      <tr>
        <td> {{$post['id']}}</td>
        <td><b><em>{{$post['name']}} </em></b></td>
        <td><b>{{$post['unit_price']}}</b></td>
        <td>{{$post['desc']}}</td>
        <td>   {{$post->active}}
      



        </td>
        <td>
          <img src="{{ asset("food_images/$post->img") }}  
" height="42" width="42" alt="no image">   
        </td>

        <td><a href="{{action('FoodController@edit', $post['id'])}}" >
          <i class="icons fa fa-pencil-square-o"></i></a></td>
        <td>

          <form action="{{action('FoodController@destroy', $post['id'])}}" method="post">
            {{csrf_field()}}
            <input name="_method" type="hidden" value="DELETE">
            <button  type="submit" class="btn_border_none"> <i class="icons fa fa-trash-o"></i></button>
          </form>
        </td>



        {{-- edit without button
         <td> 
                  <a href="/vendor_edit/{{$vendor->id}}" class="button"><i class="icons fa fa-pencil-square-o"></i></a> 
                  &nbsp;
                  <a href="/vendor_delete/{{$vendor->id}}" class="button"><i class="icons fa fa-trash-o"></i></a>
                 </td>
                  --}}
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
@endsection