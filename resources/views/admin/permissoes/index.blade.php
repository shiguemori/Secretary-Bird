@extends('layouts.master')

@section('h1', 'Permissões')

@section('content')
    <div class="form-header-classic materialize">
        @can('acl.view', 'admin.permissoes.update')
            {{ Form::open(['route' => 'admin.permissoes.update', 'class' => 'form-ladda']) }}
        @endcan
        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Label</th>
                                <th>Rota</th>
                                <th>Pertence ao menu</th>
                                <th>Ícone</th>
                                <th>Exibir no menu</th>
                                <th>Visível para edição</th>
                                <th>Visível no Mobile</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissoes as $permissao)
                                {{ Form::hidden('id[]', $permissao->id) }}
                                <tr>
                                    <td class="align-middle">
                                        {{ Form::text("label[{$permissao->id}]", $permissao->label, [
                                            'class' => 'form-control'
                                        ]) }}
                                    </td>
                                    <td class="align-middle">
                                        {{ Form::text("rota[{$permissao->id}]", $permissao->rota, [
                                            'disabled' => true,
                                            'class' => 'form-control'
                                        ]) }}
                                    </td>
                                    <td class="align-middle">
                                        {{ Form::select("permissao_id[{$permissao->id}]", $rotas, $permissao->permissao_id, [
                                            'class' => 'form-control select2-cont',
                                            'placeholder' => 'Isto é um grupo?'
                                        ]) }}
                                    </td>
                                    <td class="align-middle">
                                        {{ Form::text("icone[{$permissao->id}]", $permissao->icone, [
                                            'class' => 'form-control text-center'
                                        ]) }}
                                    </td>
                                    <td class="align-middle">
                                        <div class="checkbox text-center checkbox-success">
                                            <input id="checkbox-visivel-{{ $permissao->id }}"
                                                   {{ $permissao->visivel_menu == 1 ? "checked" : '' }} name="visivel_menu[{{ $permissao->id }}]"
                                                   type="checkbox">
                                            <label for="checkbox-visivel-{{ $permissao->id }}">Check</label>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="checkbox text-center checkbox-success">
                                            <input id="checkbox-{{ $permissao->id }}"
                                                   {{ $permissao->visivel_user == 1 ? "checked" : '' }} name="visivel_user[{{ $permissao->id }}]"
                                                   type="checkbox">
                                            <label for="checkbox-{{ $permissao->id }}">Check</label>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="checkbox text-center checkbox-success">
                                            <input id="checkbox-mobile-{{ $permissao->id }}"
                                                   {{ $permissao->mobile == 1 ? "checked" : '' }} name="mobile[{{ $permissao->id }}]"
                                                   type="checkbox">
                                            <label for="checkbox-mobile-{{ $permissao->id }}">Check</label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @can('acl.view', 'admin.permissoes.update')
            <div class="form-wizard-buttons sticky-button">
                {{ Form::submit('Salvar', [
                    'class' => 'btn btn-success btn-block btn-small ladda-button'
                ]) }}
            </div>
            {{ Form::close() }}
        @endcan
    </div>
@endsection

@section('css')
    <link href="{{ asset('idealui/assets/vendor/material-input/css/material-input.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('scripts')
@endsection
