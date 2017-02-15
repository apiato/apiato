<!DOCTYPE html>
<html lang="es">
<head>
    {{-- pace --}}
    <script src="{{ asset('plugins/pace/pace.min.js') }}"></script>
    <link href="{{ asset('plugins/pace/themes/blue/pace-theme-flash.css') }}" rel="stylesheet">

   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'AppName') }} | @yield('title')</title>

    {{-- compiled plugins --}}
    <link href="{{ asset('css/plugins.css') }}" rel="stylesheet">

    @yield ('styles')
</head>

<body class="hold-transition login-page">

    <div class="login-box">
        <div class="login-logo">
            <a href="/"><b>{{ config('app.big-name') }}</b> {{ config('app.small-name') }}</a>
        </div>
        
        {{-- main content --}}
        <div class="login-box-body">
            @yield ('content')
        </div>
        {{-- /main content --}}

    </div>


    <!-- scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    {{-- compiled plugins --}}
    <script src="{{ asset('js/plugins.js') }}"></script>

    @yield ('scripts')
</body>

</html>