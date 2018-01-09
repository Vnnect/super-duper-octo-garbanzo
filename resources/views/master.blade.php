<!-- master.blade.php -->

<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ADMIN PANEL</title>

        <!-- Fonts -->
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    </head>
    <body class="bd_image_admin_body" >
        <br><br>
        <div class="container">
        <div class="row pull-right">
                 <a href="{{url('display_vendor')}}" class="btn btn-primary" role="button" >  Display Vendors </a>
        </div>
        </div>
        <div class="row text-center">
        <a href="{{url('new_address')}}" class="btn btn-warning" role="button">Address</a>        
        <a href="{{url('new_venue')}}" class="btn btn-warning" role="button">Venue</a>       
        <a href="{{url('new_vendor')}}" class="btn btn-warning" role="button">Vendor</a>
        <a href="{{url('new_court')}}" class="btn btn-warning" role="button">Court</a> 
        <a href="{{url('new_stall')}}" class="btn btn-warning" role="button">Stall</a> <br><br>  
        </div>      
        @yield('content')
        
    </body>
</html>