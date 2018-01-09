@extends('vendor_login.layout')

@section('content')
<div class="container">

<div class="row">
    <div class="col-md-3 top4 ">
<div class="top"></div>
    <img src="logo_big.png" class="top" width="250px">
</div>
<div class="col-md-1 vline2 ">
</div>
<div class="col-md-8">
     <div class="row top">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-success">
                <div class="panel-body">
                 <h4 class="text-center"> Register Vendor </h4> 
                    <form class="form-horizontal top" role="form" method="POST" action="{{ url('vendor_login_register') }}">
                        
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-2 control-label">Vendor Name</label>

                            <div class="col-md-10">
                                <input id="name" type="text" placeholder="@ vendor name" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-2 control-label">E-Mail Address</label>

                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control" placeholder="@ name@email.com" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control" placeholder="@type in your pwd" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm </label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control" placeholder="@confirm your pwd" name="password_confirmation" required>
                            </div>
                        </div>
                            </div>
                        </div>
                        

                        

                        {{--  ******************************************OWN CODE********************************  --}}
                        
                        <div class="row">
                        <div class="col-md-6">
                             <div class="form-group">
                            <label for="name" class="col-md-4 control-label">vendor_id</label>

                            <div class="col-md-8">

                                 <select name="vendor_id" class="form-control form-control-lg" id="lgFormGroupInput" >
                                @foreach($vendor_dropper as $vendor)
                                    <option value="{{ $vendor->id }}"> {{ $vendor->name }} - {{$vendor->phone_no}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        </div>
                            <div class="col-md-6">
                                 <div class="form-group">
                            <label for="name" class="col-md-4 control-label">vendor_address_id</label>

                            <div class="col-md-8">

                                <select name="vendor_address_id" class="form-control form-control-lg" id="lgFormGroupInput" >
                                @foreach($address_dropper as $address)
                                    <option value="{{ $address->id }}"> {{ $address->street }} - {{$address->addressline1}} - {{$address->landmark}} - {{$address->pincode}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                            </div>
                            </div>
                            <div class="row"  >
                            <div class="col-md-6">
                                 <div class="form-group">
                            <label for="name" class="col-md-4 control-label">vendor_venue_id</label>

                            <div class="col-md-8">

                                 <select name="vendor_venue_id" class="form-control form-control-lg" id="lgFormGroupInput" >
                                @foreach($venue_dropper as $venue)
                                    <option value="{{ $venue->id }}"> {{ $venue->name }} - {{$venue->code}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                            </div>

                        <div class="col-md-6">
                                <div class="form-group">
                            <label for="name" class="col-md-4 control-label">vendor_court_id</label>

                            <div class="col-md-8">

                                 <select name="vendor_court_id" class="form-control form-control-lg" id="lgFormGroupInput" >
                                @foreach($court_dropper as $court)
                                    <option value="{{ $court->id }}"> {{ $court->name }} - {{ $court->location_code }} - {{$court->land_mark}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6" >
                               <div class="form-group">
                            <label for="name" class="col-md-4 control-label">vendor_stall_id</label>

                            <div class="col-md-8">

                                 <select name="vendor_stall_id" class="form-control form-control-lg" id="lgFormGroupInput" >
                                @foreach($stall_dropper as $stall)
                                    <option value="{{ $stall->id }}"> {{ $stall->stall_no }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        </div>
                        </div>
                        
                        
                         
                      
                         <div class="form-group">
                           
                            <div class="col-md-6">
                                <input type="hidden" name="is_ven_or_sub" value="0">
                            </div>
                        </div>

                        

                            {{--  ********************************************END OWN CODE *********************************  --}}
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    Register Login For Vendor
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
   
@endsection
