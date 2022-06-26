<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'My Task')</title>
    <meta name="description" content="@yield('meta_description', 'Laravel Starter')">
    <meta name="author" content="@yield('meta_author', 'FasTrax Infotech')">
    @yield('meta')

    {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
    @stack('before-styles')

    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->
    {{ style(asset('css/backend.css')) }}

    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">

    @stack('after-styles')
    <style>
        .hidden {
            display: none !important;
        }
    </style>
</head>
<body class="app header-fixed sidebar-fixed aside-menu-off-canvas sidebar-lg-show">
    @include('includes.header')

    <div class="app-body">
        @include('includes.sidebar')

        <main class="main">
        {!! Breadcrumbs::render() !!}
            <div class="container-fluid">
                <div class="animated fadeIn">
                    <div class="content-header">
                        @yield('page-header')
                    </div>
                    <!--content-header-->

                    @yield('content')
                </div>
                <!--animated-->
            </div>
            <!--container-fluid-->
        </main>
        <!--main-->

        @include('includes.aside')
    </div>
    <!--app-body-->

    @include('includes.footer')

    <!-- Scripts -->
    @stack('before-scripts')
    {!! script(asset('js/manifest.js')) !!}
    {!! script(asset('js/vendor.js')) !!}
    {!! script(asset('js/backend.js')) !!}
    <script src="{{ asset('/js/tinymce/tinymce.min.js')}}"></script>
    {!! script(asset('js/backend/common.js')) !!}
    @isset($js)
    
    @foreach($js as $j)
    {!! script(asset('js/backend/'. $j. '.js')) !!}
    @endforeach
    @endif

    @stack('after-scripts')

    @yield('pagescript')
</body>

</html>