<!-- vendor_create.blade.php -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

@extends('master')
@section('content')

 @if (Session::has('message'))
   <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif


<div class="container">
  <form method="post" action="{{url('new_vendor')}}">

                    <u><h1> New Vendor</h1></u><br>
  
     @include('errors.error')


    <div class="form-group row" id="myform">
      {{csrf_field()}}

          {{--  insertion for pg_vendor table  --}}
          <label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Bank A/C Number</label>
          <div class="col-sm-10">
              <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="A/c Number" name="bank_account_no">
            </div>
          </div>

        <div class="row">
        <div class="col-md-6">
        <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-4 col-form-label col-form-label-sm">Bank Account Name</label>
          <div class="col-sm-8">
              <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Bank Account Name" name="bank_account_name">
            </div>
          </div>
        </div>
        <div class="col-md-6">
        <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-4 col-form-label col-form-label-sm">Account Type</label>
          <div class="col-sm-8">
              <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="A/c Type eg: sa, ca" name="account_type">
          </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-4 col-form-label col-form-label-sm">Vendor Name</label>
          <div class="col-sm-8">
            <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Name" name="name">
          </div>
        </div>
        </div>

        <div class="col-md-6">
           <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-4 col-form-label col-form-label-sm">Short code</label>
          <div class="col-sm-8">
            <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Eg: INF, KFC" name="code">
          </div>
        </div>

        </div>


        <div class="col-md-6">
            <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-4 col-form-label col-form-label-sm">PAN Number</label>
          <div class="col-sm-8">
            <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="PAN Number" name="pancard_no">
          </div>
        </div>

        </div>


        <div class="col-md-6">
             <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-4 col-form-label col-form-label-sm">verified_date</label>
          <div class="col-sm-8">
            <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="2017-10-28" name="verified_date">
          </div>
        </div>
        </div>


        </div>
        
        <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Address</label>
          <div class="col-sm-10">
           

          {{--  drop down menu for displaying all the names of venue  --}}
     <select name="address_id" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Address ID fk">
      @foreach($drop as $droper)
      <option value="{{ $droper->address_id }}">{{ $droper->name }}</option>
      @endforeach
    </select>



          </div>
        </div>

        

        <div class="row">
        <div class="col-md-4">
              <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-6 col-form-label col-form-label-sm">Contact Person Name</label>
          <div class="col-sm-6">
            <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Contact Name" name="contact_person">
          </div>
        </div>
        </div>
        <div class="col-md-4">
           <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-4 col-form-label col-form-label-sm">Phone Num</label>
          <div class="col-sm-8">
            <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Phone" name="phone_no">
          </div>
        </div>
        </div>

        <div class="col-md-4">
             
        <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm"> Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Email" name="contact_email">
          </div>
        </div>

        </div>
        <div class="col-md-4">
             
        <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm"> Active</label>
          <div class="col-sm-10">
                 <input type="checkbox" name="active" checked ><br>
          </div>
        </div>

        </div>
        <div class="col-md-4">
             
        <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm"> Verified</label>
          <div class="col-sm-10">
                 <input type="checkbox" name="verified" checked ><br>
          </div>
        </div>

        </div>




        </div>
       
        

       
      {{--  submit button   --}}
    <div class="form-group row">
      <div class="col-md-2 "></div>
      <input type="submit" class="btn btn-success sub">
    </div>


  </form>
</div>
@endsection



                              {{--  TO CONVERT FORM DATA TO JSON FORMAT   --}}

{{--  <script>   

  $(document).ready(function(){

      $.fn.serializeObject = function()
  {
      var o = {};
      var a = this.serializeArray();
      $.each(a, function() {
          if (o[this.name] !== undefined) {
              if (!o[this.name].push) {
                  o[this.name] = [o[this.name]];
              }
              o[this.name].push(this.value || '');
          } else {
              o[this.name] = this.value || '';
          }
      });
      return o;
  };

  $(function() {
      $('form').submit(function() {
          $('#result').text(JSON.stringify($('form').serializeObject()));
          
        //  $('#result').text(JSON.stringify($('form').serializeObject()));
       form.submit();
        //  return false;
      });
  });
  
  });  


  </script>  --}}

<!-- <h2>JSON</h2>
<pre id="result">
</pre> -->


