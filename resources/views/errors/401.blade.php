@extends('layouts.master')

@section('h1')

@endsection

@section('content')
    <h1 class="text-center">Oops...</h1>
    <div class="alert_widget yellow">
        <div>
            <div class="text-center">
                <span><i class="fas fa-lock"></i></span>
            </div>
        </div>
        <h2 class="text-center">Você não tem permissão para<br/>acessar essa página!</h2>
    </div>
    <br/>
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <a href="{{ route('admin.dashboard') }}" style="display: block;width: 100%;text-align: center;margin-top: 10px;font-size: 2em;"><< Voltar para Home</a>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .alert_widget>div i {
            font-size: 110px;
            line-height: 169px;
        }
    </style>
@endsection

@section('scripts')

@endsection