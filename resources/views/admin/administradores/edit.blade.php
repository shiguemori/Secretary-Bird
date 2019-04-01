@extends('layouts.master')

@section('h1', 'Editar Administrador')

@section('content')
    @if($administradores->id != 1 || Auth::guard('admin')->id() == $administradores->id)
        <div class="form-header-classic materialize">
            {{ Form::model($administradores, ['class' => 'form-ladda', 'route' => ['admin.administradores.edit', $administradores->id]]) }}
            {{ Form::hidden('_method', 'POST') }}
            {{ Form::hidden('id') }}
            <fieldset class='informacoes'>
                <div class="card-box">
                    @include('admin.administradores.blocks.informacoes')
                </div>
            </fieldset>

            @include('admin.administradores.blocks.permissoes')

            <div class="form-wizard-buttons sticky-button">
                <button type="submit" class="btn btn-success btn-block btn-small ladda-button">Salvar</button>
            </div>
            {{ Form::close() }}
        </div>
    @endif
@endsection

@section('css')
@endsection

@section('scripts')
@endsection
