<?php
$controllerName = '';
switch ($controller) {
    case 'users':
        $controllerName = 'Usuários';
        $nomeRota = lcfirst($controller);
        break;

    case 'Relatorios':
        $controllerName = ucfirst($controller);
        $nomeRota = 'admin.dashboard';
        break;

    default:
        $controllerName = ucfirst($controller);
        $nomeRota = lcfirst($controller);
        break;
}
?>
<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a class="link-out" href="{{ route('admin.dashboard') }}">{{ env('APP_NAME') }}</a></li>
    @if($action == 'index')
        <li class="breadcrumb-item active">{{ $controllerName }}</li>
    @else
        <li class="breadcrumb-item"><a class="link-out" href="{{ route('admin.'.lcfirst($nomeRota) . '.index') }}">{{ ucfirst($controllerName) }}</a></li>
        <li class="breadcrumb-item active">@yield('h1')</li>
    @endif
</ol>