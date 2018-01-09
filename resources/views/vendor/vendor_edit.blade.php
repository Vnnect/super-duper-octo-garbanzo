<!-- vendor_edit.blade.php -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@extends('vendor_login.auth.admin_layout')
@section('content')



<div class="container">
                    <h5> USER ID : {{ ($data) ? $data['id']: '' }}</h5>


  <form method="post" action="{{url('vendor_update')}}">

                    <u><h1> Edit Vendor</h1></u>

  
    <div class="form-group row" id="myform">
      {{csrf_field()}}

          {{--  edit for pg_vendor table  --}}


           {{--  hidden type not to edit and also id is used to update the coresepoding data  --}}
          
           <input type="hidden"  name="userId" value=" {{ ($data) ? $data['id']: '' }} "> 

          <label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Bank A/C Number</label>
          <div class="col-sm-10">
              <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="A/c Number" name="bank_account_no" value=" {{ ($data) ? $data['bank_account_no']: '' }} ">
            </div>
          </div>

    <div class="row">
      <div class="col-md-6">
            <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-4 col-form-label col-form-label-sm">Bank Account Name</label>
          <div class="col-sm-8">
              <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Bank Account Name" name="bank_account_name" value=" {{ ($data) ? $data['bank_account_name']: '' }}">
            </div>
          </div>
      </div>
      <div class="col-md-6">
             <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-4 col-form-label col-form-label-sm">Account Type</label>
          <div class="col-sm-8">
              <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="A/c Type eg: sa, ca" name="account_type" value=" {{ ($data) ? $data['account_type']: '' }}">
          </div>
          </div>

      </div>

      <div class="col-md-6">
        <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-4 col-form-label col-form-label-sm">Vendor Name</label>
          <div class="col-sm-8">
            <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Name" name="name" value=" {{ ($data) ? $data['name']: '' }}">
          </div>
        </div>
      </div>

      <div class="col-md-6">
         <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-4 col-form-label col-form-label-sm">Short code</label>
          <div class="col-sm-8">
            <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Eg: INF, KFC" name="code" value=" {{ ($data) ? $data['code']: '' }}">
          </div>
        </div>
      </div>

      <div class="col-md-6">
           <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-4 col-form-label col-form-label-sm">PAN Number</label>
          <div class="col-sm-8">
            <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="PAN Number" name="pancard_no" value=" {{ ($data) ? $data['pancard_no']: '' }} ">
          </div>
        </div>

      </div>
      <div class="col-md-6">
           <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-4 col-form-label col-form-label-sm">verified_date</label>
          <div class="col-sm-8">
            <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Date" name="verified_date" value=" {{ ($data) ? $data['verified_date']: '' }} ">
          </div>
        </div>
      </div>

      

    </div>
        

       
        

       
        
            
       

        <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">address_id</label>
          <div class="col-sm-10">
            <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Address ID fk" name="address_id" value=" {{ ($data) ? $data['address_id']: '' }} ">
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
               <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-6 col-form-label col-form-label-sm">Contact Person Name</label>
          <div class="col-sm-6">
            <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Contact Name" name="contact_person" value=" {{ ($data) ? $data['contact_person']: '' }} ">
          </div>
        </div>
          </div>
          <div class="col-md-4">
             <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-4 col-form-label col-form-label-sm">Phone Num</label>
          <div class="col-sm-8">
            <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Phone" name="phone_no" value=" {{ ($data) ? $data['phone_no']: '' }} ">
          </div>
        </div>
          </div>
          <div class="col-md-4">
            <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-4 col-form-label col-form-label-sm">Email</label>
          <div class="col-sm-8">
            <input type="email" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="email" name="contact_email" value=" {{ ($data) ? $data['contact_email']: '' }} ">
          </div>
        </div>
          </div>
        </div>       

       
       

        
        

      {{--  submit button   --}}
    <div class="form-group row">
      <div class="col-md-2"></div>
      <input type="submit" class="btn btn-primary">
    </div>


  </form>
</div>
@endsection
