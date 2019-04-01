<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <link rel="shortcut icon" href="{{ asset('images/favicon.png')}}">
    <link href="{{ asset('greeva/dist/libs/@mdi/font/css/materialdesignicons.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('greeva/dist/libs/dripicons/webfont/webfont.css')}}" rel="stylesheet"/>
    <link href="{{ asset('greeva/dist/libs/simple-line-icons/css/simple-line-icons.css')}}" rel="stylesheet"/>
    <link href="{{ asset('idealui/assets/vendor/material-input/css/material-input.css')}}" rel="stylesheet"/>
    <link href="{{ asset('greeva/dist/css/app.css')}}" rel="stylesheet"/>
    <link href="{{ asset('css/login/login.css')}}" rel="stylesheet"/>

    <title>{{ env('APP_NAME') }}</title>
</head>
<body class="bg-account-pages">
<section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="wrapper-page">
                    <div class="account-pages">
                        <div class="account-box">
                            <div class="account-logo-box">
                                @include('flash::message')
                                @include('layouts.elements.validator')
                                <h2 class="text-uppercase text-center">
                                    <a href="https://idealtrends.com.br" target="_blank" class="text-success">
                                        <span><img src="{{ asset('images/logo.png')}}" alt="" height="60"></span>
                                    </a>
                                </h2>
                            </div>
                            <div class="account-content">
                                {{ Form::open(['route' => 'noacl.route.login.submit']) }}
                                @csrf
                                <div class="col-md-12 materialize mb-3">
                                    <div class="form-label-group">
                                        <input type="text" id="email" name="email" class="form-control required {{ $errors->has('email') ? ' input-error' : '' }}"
                                               placeholder="{{__('Insira seu email de acesso')}}" required="required" autofocus>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>{{__('Email')}}</label>
                                        @if ($errors->has('email'))
                                            <span class="error-msg">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12 materialize mb-3">
                                    <div class="form-label-group">
                                        <input type="password" id="password" name="password" class="form-control required {{ $errors->has('password') ? ' input-error' : '' }}"
                                               placeholder="{{__('Insira sua senha')}}" required="required">
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>{{__('Senha')}}</label>
                                        @if ($errors->has('password'))
                                            <span class="error-msg">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="button-container">
                                    <button type="submit"><span>Entrar</span></button>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('greeva/dist/libs/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('greeva/dist/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('greeva/dist/libs/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>

<script src="{{ asset('greeva/dist/js/jquery.core.js')}}"></script>
<script src="{{ asset('greeva/dist/js/jquery.app.js')}}"></script>

</body>
</html>