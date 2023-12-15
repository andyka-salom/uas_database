<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin-Kasir</title>

    <!-- CSS FILES -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <link href="{{ asset('styles.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        @include('layouts.nav')
        <main>
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>

    <!-- JAVASCRIPT FILES -->
   
</body>
</html>
