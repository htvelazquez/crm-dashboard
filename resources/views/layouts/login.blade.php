<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE-2.4.2/bower_components/bootstrap/dist/css/bootstrap.min.css") }}">
    <!-- Font Awesome -->
    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE-2.4.2/dist/css/AdminLTE.min.css") }}">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <!-- link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE-2.4.2/dist/css/skins/skin-blue.min.css") }}" -->
    <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE-2.4.2/dist/css/skins/skin-green-light.min.css") }}">
    <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE-2.4.2/bower_components/jquery-ui/themes/base/jquery-ui.min.css") }}">

    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

    <!-- link rel="stylesheet" href="{{ asset("/css/customer-success.css") }}" -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--script type="text/javascript" src="  http://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.widgets.js"></script-->
    <!--script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.charts.js"></script-->
    <!--script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.theme.fusion.js"></script-->

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body class="skin-green-light">
    <div id="v-app" class="">
        @if (null !== auth()->user())
        <div class="logout-box">
            <a href="/logout" title="Exit - {{ Auth::user()->name }}"><i class="fas fa-sign-out-alt"></i></a>
        </div>
        @endif

        @yield('content')
    </div>

    <!-- REQUIRED JS SCRIPTS -->
    <script src="{{ asset ("/bower_components/AdminLTE-2.4.2/bower_components/jquery/dist/jquery.min.js") }}"></script>
    <script src="{{ asset ("/bower_components/AdminLTE-2.4.2/bower_components/jquery-ui/jquery-ui.min.js") }}"></script>
    <!--script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script-->

    <!-- Bootstrap 3.3.6 -->
    <script src="{{ asset ("/bower_components/AdminLTE-2.4.2/bower_components/bootstrap/dist/js/bootstrap.min.js") }}"></script>

    <script src="{{ asset ("/bower_components/AdminLTE-2.4.2/dist/js/adminlte.min.js") }}"></script>
    @stack('scripts')
</body>
</html>