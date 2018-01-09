@extends('vendor_login.layout')

@section('content')

 
<div class="container">
<div class="row">
<div class="row">
    <div class=" col-md-8 login_box">
	    <div align="center">
            <div class="line"><h3>Welcome Back</h3></div>
            <div class="outter"><img src="User_Avatar.png" class="image-circle"/></div>   
            <h1>{{$main_vendor->name}}</h1>
            <span>Tech Park- Address</span>
            <form method="POST" action="{{ url('/stall_foods_re') }}">
    <input type="hidden" name="vendor_stall_id" value="{{$main_vendor->vendor_stall_id}}">
   <button class="btn btn-success" type="submit"> Visit Stall</button>
</form>
	    </div>
        <div class="col-md-6 col-xs-6 follow line" align="center">
            <h3>
                {{$venue->name}}<br/> <span>Vendor Name</span>
            </h3>
        </div>
        <div class="col-md-6 col-xs-6 follow line" align="center">
            <h3>
                {{$court->name}} <br/> <span> Court Name</span>
            </h3>
        </div>
        <div class="col-md-12s col-xs-12 follow line" align="center">
            <h3>
                {{$address->addressline1}} <br/> <span> LandMark</span>
            </h3>
        </div>


        
</div>
</div>

</div>
</div>

<div class="container">
<div class="row">

 @if($vendor)

                    These are your sub vendors : <br><br>

                     @foreach ($vendor as $ven)

                        <p>This is user id = {{ $ven->id }}</p>
                        <p>This is user name = {{ $ven->name }}</p>
                        <p>This is user email = {{ $ven->email }}</p>
                        <p>This is user sub_ven_id =  {{ $ven->sub_vendor_id }}</p>
                        <p>This is user vendor_id = {{ $ven->vendor_id }}</p>
                        <p>This is user sub_vendor_address_id = {{ $ven->sub_vendor_address_id }}</p>
                        <p>This is user sub_vendor_venue_id {{ $ven->sub_vendor_venue_id }}</p>
                        <p>This is user sub_vendor_court_id = {{ $ven->sub_vendor_court_id }}</p>
                        <p>This is user sub_vendor_stall_id =  {{ $ven->sub_vendor_stall_id }}</p>


                <form method="POST" action="{{ url('/stall_foods_subvendor') }}">
                    <input type="hidden" name="vendor_stall_id" value="{{$ven->sub_vendor_stall_id }}">
                   <button class="btn btn-success" type="submit"> Visit Stall</button>
                </form>
                        <br><hr>
                    @endforeach
            @endif

	
    </div>
    </div>
@endsection