<html>
<head>
    <title>
        Peeps
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('index.css')}}" rel="stylesheet">
    <script src="{{asset('jquery-1.12.3.min.js')}}"> </script>
    <script src="{{asset('index.js')}}"></script>
</head>
<body>
    @yield('content')
</body>
</html>
