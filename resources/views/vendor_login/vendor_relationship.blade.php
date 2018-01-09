@extends('home')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Vendor Relationship</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('vendor_relationship') }}">
                        
                        {{ csrf_field() }}
                
                        {{--  ******************************************OWN CODE********************************  --}}
                         <div class="form-group">
                            <label for="name" class="col-md-4 control-label">vendor_id</label>

                            <div class="col-md-6">

                                 <select name="vendor_id" class="form-control form-control-lg" id="lgFormGroupInput" >
                                @foreach($vendor_dropper as $vendor)
                                    <option value="{{ $vendor->id }}"> {{ $vendor->name }} - {{$vendor->phone_no}}- {{$vendor->code}}- {{$vendor->pancard_no}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                                      <h5>  <em> <b> Belongs too :</b></em></h5> 
                       

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">sub_vendor_id</label>

                            <div class="col-md-6">

                                 <select name="sub_vendor_id" class="form-control form-control-lg" id="lgFormGroupInput" >
                                @foreach($vendor_dropper as $vendor)
                                    <option value="{{ $vendor->id }}"> {{ $vendor->name }} - {{$vendor->phone_no}}- {{$vendor->code}}- {{$vendor->pancard_no}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                       
                            {{--  ********************************************END OWN CODE *********************************  --}}
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                   Make Vendor Relationship
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
