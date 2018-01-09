<!-- master.blade.php -->

<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Food Operations</title>

        <!-- Fonts -->
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    </head>
    <body>
    <div class="container">
        <h2>Vendor Stall Manager</h2>

          <a href="{{url('stall_foods/create')}}" class="btn btn-primary" role="button">Add New Food Item</a><br><br>        

          {{-- <a href="{{ URL::to('downloadExcel/xls') }}"><button class="btn btn-success">Download Orders iin Excel xls</button></a>
        
        <a href="{{ URL::to('downloadExcel/csv') }}"><button class="btn btn-success">Download Orders in CSV</button></a>
        <br><br> --}}
        </div>
        @yield('content')
    </body>
</html>