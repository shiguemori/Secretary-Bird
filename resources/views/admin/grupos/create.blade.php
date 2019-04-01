@extends('layouts.master')

@section('h1', 'Adicionar Grupo')

@section('content')
    <div class=" form-header-classic materialize">
        {{ Form::open(['class' => 'form-ladda']) }}
        <fieldset class='formulario'>
            <div class="card-box">
                @include('admin.grupos.blocks.formulario')
            </div>
        </fieldset>
        <div class="form-wizard-buttons sticky-button">
            <button type="submit" class="btn btn-success btn-block btn-small ladda-button">Salvar</button>
        </div>
        {{ Form::close() }}
    </div>
@endsection

@section('css')
@endsection

@section('scripts')
@endsection
