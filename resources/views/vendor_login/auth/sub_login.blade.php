@extends('vendor_login.sub_layout')
  @include('errors.error')
@section('content')
<div class="container">
<div class="row">
        <div class="col-md-4 top4 ">
<div class="top"></div>
    <img src="logo_big.png" class="top" width="250px">
</div>
<div class="col-md-2 vline2 ">
</div>
<div class="col-md-6 top4">
         <div class="row top">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-success">
                <div class="panel-body">
                 <h4 class="text-center"> Sub-Vendor Login </h4> 
                    <form class="form-horizontal top" role="form" method="POST" action="{{ url('/sub_vendor_login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" placeholder="@ name@email.com" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" placeholder="@ type in your password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    Login
                                </button>
{{-- 
                                <a class="btn btn-link" href="{{ url('/seller_password/reset') }}">
                                    Forgot Your Password?
                                </a> --}}
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