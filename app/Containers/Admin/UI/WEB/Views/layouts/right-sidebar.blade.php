<!DOCTYPE html>
<html lang="es">
<head>
    {{-- pace --}}
    <script src="{{ asset('plugins/pace/pace.min.js') }}"></script>
    <link href="{{ asset('plugins/pace/themes/white/pace-theme-flash.css') }}" rel="stylesheet">

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

<body class="hold-transition skin-black-light sidebar-mini">
    <div id="wrapper">

        {{-- main header --}}
        @include ('admin::partials.header')
        {{-- main header --}}

        {{-- main sidebar --}}
        @include ('admin::partials.sidebar-left')
        {{-- /main sidebar --}}

        <div class="content-wrapper">
            
            {{-- main content --}}
            @yield ('content')
            {{-- /main content --}}

        </div>

        {{-- main footer --}}
        @include ('admin::partials.footer')
        {{-- main footer --}}

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