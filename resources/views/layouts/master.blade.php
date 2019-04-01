<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <title>Clínica Ideal</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}">
    <!-- Icons css -->
    <link href="{{asset('greeva/dist/libs/@mdi/font/css/materialdesignicons.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('greeva/dist/libs/dripicons/webfont/webfont.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('greeva/dist/libs/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- MetisMenu CSS -->
    <link href="{{asset('greeva/dist/libs/metismenu/metisMenu.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Sweet Alert -->
    <link href="{{asset('greeva/dist/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('greeva/dist/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('greeva/dist/libs/mohithg-switchery/switchery.min.css') }}" rel="stylesheet">
    <link href="{{ asset('greeva/dist/libs/jquery-ui/themes/base/datepicker.css') }}" rel="stylesheet"/>
    <link href="{{ asset('greeva/dist/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('greeva/dist/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet"/>
    <!-- Ladda Button -->
    <link href="{{ asset('greeva/dist/libs/ladda/ladda.min.css') }}" rel="stylesheet"/>
    <!-- IdealUI -->
    <link href="{{asset('idealui/assets/css/idealui-toolkit.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('idealui/assets/vendor/form-wizard/css/form-wizard.css') }}" rel="stylesheet" type="text/css"/>
    <!-- App css -->
    <link href="{{asset('greeva/dist/css/app.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/core.css')}}" rel="stylesheet" type="text/css"/>
    @yield('css')
</head>

<body>

<!-- Navigation Bar-->
<header id="topnav">
    <nav class="navbar-custom">

        <div class="container-fluid">
            <ul class="list-unstyled topbar-right-menu float-right mb-0">
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <i class="dripicons-bell noti-icon"></i>
                        <span class="badge badge-danger badge-pill noti-icon-badge">4</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="m-0"><span class="float-right"><a href="" class="text-dark"><small>Limpar todos</small></a> </span>Notificações</h5>
                        </div>

                        <div class="slimscroll noti-scroll">
                            @include('admin.elements.notifications')
                        </div>

                        <!-- All-->
                        <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                            Ver todos <i class="fi-arrow-right"></i>
                        </a>

                    </div>
                </li>

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('images/user_blank.png') }}" alt="user" class="rounded-circle"> <span class="ml-1">{{ Auth::guard('admin')->user()->nome }} <i class="mdi mdi-chevron-down"></i> </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                        <div class="dropdown-item noti-title">
                            <h6 class="text-overflow m-0">Bem Vindo!</h6>
                        </div>
                        <a href="{{route('admin.administradores.edit', Auth::guard('admin')->user()->id) }}" class="dropdown-item notify-item link-out">
                            <i class="dripicons-user"></i> <span>Conta</span>
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="dripicons-gear"></i> <span>Configurações</span>
                        </a>
                        <a href="{{ route('noacl.route.login.logout') }}" class="dropdown-item notify-item">
                            <i class="dripicons-power"></i> <span>Sair</span>
                        </a>
                    </div>
                </li>
                <li class="dropdown notification-list">
                    <a href="javascript:void(0);" class="nav-link right-bar-toggle">
                        <i class="dripicons-gear noti-icon"></i>
                    </a>
                </li>
                <li class="dropdown notification-list">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle nav-link">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </li>

            </ul>

            <ul class="list-inline menu-left mb-0">
                <li class="float-left">
                    <a href="{{route('admin.dashboard')}}" class="logo">
                        <span class="logo-lg">
                            <img src="{{ asset('images/logo_dark.png') }}" alt="" height="30">
                        </span>
                        <span class="logo-sm">
                            <img src="{{ asset('images/logo_full_dark.png') }}" alt="" height="40">
                        </span>
                    </a>
                </li>
            </ul>
        </div>

    </nav>
    <!-- end topbar-main -->

    <div class="topbar-menu">
        <div class="container-fluid">
            <div id="navigation">
                <!-- Navigation Menu-->
                @include('admin.elements.menu')
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

</header>

<div class="wrapper">
    <div class="container-fluid">
        <!-- Page title box -->
        <div class="page-title-box">
            @if (!\Request::is('/'))
                <a href="{{ URL::previous() }}" role="button" class="header-icon btn-voltar link-out">
                    <i class="mdi mdi-chevron-left"></i>
                </a>
            @endif
            @include('admin.elements.breadcrumb')
            <h4 class="page-title @if (\Request::is('/')) p-0 @endif">@yield('h1')</h4>
        </div>
        <div class="content_container">
            @include('flash::message')
            @include('layouts.elements.validator')
            @yield('content')
        </div>
    </div>
</div>
<!-- end wrapper -->

<!-- Footer -->
<footer class="footer">
    @include('admin.elements.footer')
</footer>
<!-- End Footer -->

@include('admin.elements.rightbar')

<!-- jQuery  -->
<script src="{{asset('greeva/dist/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('greeva/dist/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('greeva/dist/libs/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- SweetAlert -->
<script src="{{ asset('greeva/dist/libs/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- KNOB JS -->
<script src="{{ asset('greeva/dist/libs/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- MetisMenu JS -->
<script src="{{ asset('greeva/dist/libs/metismenu/metisMenu.min.js')}}"></script>
<!-- Jvector map -->
<script src="{{ asset('greeva/dist/libs/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{ asset('greeva/dist/libs/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- Jquery-Ui -->
<script src="{{ asset('greeva/dist/libs/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('greeva/dist/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('greeva/dist/libs/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- Masks -->
<script src="{{ asset('greeva/dist/libs/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('greeva/dist/libs/jquery-maskmoney/jquery.maskMoney.min.js') }}"></script>
<script src="{{ asset('greeva/dist/libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('greeva/dist/libs/mohithg-switchery/switchery.min.js') }}"></script>
<script src="{{ asset('greeva/dist/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('greeva/dist/libs/moment/moment.js') }}"></script>
<script src="{{ asset('greeva/dist/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('greeva/dist/libs/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
<script src="{{ asset('greeva/dist/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<!-- Ladda Button -->
<script src="{{ asset('greeva/dist/libs/ladda/spin.min.js') }}"></script>
<script src="{{ asset('greeva/dist/libs/ladda/ladda.min.js') }}"></script>
<!-- App js -->
<script src="{{asset('greeva/dist/js/jquery.core.js')}}"></script>
<script src="{{asset('greeva/dist/js/jquery.app.js')}}"></script>
<!-- IdealUI -->
<script src="{{asset('idealui/assets/js/idealui-toolkit.js')}}"></script>
<script>
    IdealUiJs.baseUrl = '{{ \Illuminate\Support\Facades\URL::to('/') }}';
</script>
<script src="{{ asset('idealui/assets/vendor/form-wizard/js/form-wizard.js') }}"></script>
<!-- Core.js -->
<script src="{{asset('js/core.js')}}"></script>

@include('admin.elements.flash')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('scripts')
</body>
</html>
