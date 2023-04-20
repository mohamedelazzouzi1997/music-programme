<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/x-icon"> <!-- Favicon-->
    <title>{{ config('app.name') }} - @yield('title')</title>
    <meta name="description" content="@yield('meta_description', config('app.name'))">
    <meta name="author" content="@yield('meta_author', config('app.name'))">
    <script src="https://kit.fontawesome.com/f4eca1ee68.js" crossorigin="anonymous"></script>
    @yield('meta')
    {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
    @stack('before-styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    @if (trim($__env->yieldContent('page-style')))
        @yield('page-style')
    @endif
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('toaster/toaster.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
    @stack('after-styles')
</head>

<body class="theme-blue">
    <!-- Page Loader -->
    <div class="page-loader-wrapper flex justify-center">
        <div class="loader">
            <div class="m-t-30"><img class="zmdi-hc-spin" src="{{ asset('assets/images/logo.png') }}" width="48"
                    height="48" alt="Aero"></div>
            {{-- <p>Please wait...</p> --}}
        </div>
    </div>
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    {{-- @include('layouts.navbarright') --}}
    @include('layouts.sidebar')
    {{-- @include('layouts.rightsidebar') --}}
    <section style="margin-right: 20px" class="content shadow-2xl">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>@yield('title')</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-blue-900" href="{{ route('dashboard') }}"><i
                                    class="zmdi zmdi-home"></i>
                                Music Programe</a></li>
                        @if (trim($__env->yieldContent('parentPageTitle')))
                            <li class="breadcrumb-item">@yield('parentPageTitle')</li>
                        @endif
                        @if (trim($__env->yieldContent('title')))
                            <li class="breadcrumb-item active">@yield('title')</li>
                        @endif
                    </ul>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                            class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            @yield('content')
        </div>
    </section>
    @yield('modal')
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"
        integrity="sha256-a2yjHM4jnF9f54xUQakjZGaqYs/V1CYvWpoqZzC2/Bw=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script>

    <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
    <script src="{{ asset('toaster/toaster.js') }}"></script>
    @yield('scripts')
</body>

</html>
