    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield("title")
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="{{asset('/public/storage/photos/4/favicon.jpg')}}">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('/public/storage/photos/4/favicon.jpg')}}">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('/public/storage/photos/4/favicon.jpg')}}">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('/public/storage/photos/4/favicon.jpg')}}">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('/public/storage/photos/4/favicon.jpg')}}">
    <!-- Styles -->
    {{-- <link href="{{('public/backend/css/lib/calendar2/pignose.calendar.min.css')}}" rel="stylesheet"> --}}
    {{-- <link href="{{('public/backend/css/lib/chartist/chartist.min.css')}}" rel="stylesheet"> --}}
    <link href="{{('/public/backend/css/lib/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{('/public/backend/css/lib/themify-icons.css')}}" rel="stylesheet">
    <link href="{{('/public/backend/css/lib/owl.carousel.min.css')}}" rel="stylesheet" />
    <link href="{{('/public/backendcss/lib/owl.theme.default.min.css')}}" rel="stylesheet" />
    <link href="{{('/public/backend/css/lib/weather-icons.css')}}" rel="stylesheet" />
    <link href="{{('/public/backend/css/lib/menubar/sidebar.css')}}" rel="stylesheet">
    <link href="{{('/public/backend/css/lib/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{('/public/backend/css/lib/helper.css')}}" rel="stylesheet">
    <link href="{{asset('/public/backend/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    @stack('styles')
