@extends('vendor_login.sub_layout')

@section('content')




<div class="container">
<div class="row">
<div class="row">
    <div class=" col-md-8 login_box">
	    <div align="center">
            <div class="line"><h3>Welcome Back</h3></div>
            <div class="outter"><img src="User_Avatar.png" class="image-circle"/></div>   
            <h1>{{ $sub_vendor->name}} </h1>
            <span>Tech Park- Address</span>
            <form method="POST" action="{{ url('/stall_foods_re') }}">
                        <input type="hidden" name="vendor_stall_id" value="{{$sub_vendor->sub_vendor_stall_id }}">
                       <button class="btn btn-success btn-padding" type="submit"> Visit Stall</button>
                    </form>
	    </div>
        <div class="col-md-6 col-xs-6 follow line top" align="center">
            <h3>
                 {{ $sub_vendor_venue->name}}<br/>Sub Vendor Stall ID
            </h3>
        </div>
        <div class="col-md-6 col-xs-6 follow line top" align="center">
            <h3>
                 {{ $sub_vendor_address->landmark}}<br/>Landmark
            </h3>
        </div>
        <div class="col-md-6 col-xs-6 follow line top" align="center">
            <h3>
                {{$parent_vendor}} <br/> <span> Parent Vendor</span>
            </h3>
            
        </div>
<br>
<br>
<br>
       
</div>
</div>
@endsection