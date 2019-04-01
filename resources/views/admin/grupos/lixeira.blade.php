@extends('layouts.master')

@section('h1', 'Lixeira de Grupos')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="toolbar row mb-3">
                <form action="" method="get" class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                    @include('admin.elements.filters.searchbar')
                </form>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-1">
                    <a href="{{ route('admin.grupos.trashed') }}" class="btn btn-outline-danger btn-toolbar addAction text-uppercase d-block" data-toggle="tooltip" title="Limpar pesquisa">
                        <i class="mdi mdi-filter-remove"></i>
                    </a>
                </div>
                @can('acl.view', 'admin.grupos.index')
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                        <a href="{{ route('admin.grupos.index') }}" class="btn btn-outline-dark btn-toolbar addAction text-uppercase d-block" data-toggle="tooltip" title="Lista de grupos">
                            <i class="mdi mdi-format-list-numbers mr-2"></i> <span class="hidden-xs hidden-sm">Grupos</span>
                        </a>
                    </div>
                @endcan
            </div>
            <div class="card-box">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Data de criação</th>
                            <th>Data de atualização</th>
                            <th>Data de exclusão</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($grupos as $grupo)
                            <tr>
                                <td class="align-middle" scope="row">{{ $grupo->id }}</td>
                                <td class="align-middle" nowrap>{{ $grupo->titulo }}</td>
                                <td class="align-middle">{{ $grupo->created_at }}</td>
                                <td class="align-middle">{{ $grupo->updated_at }}</td>
                                <td class="align-middle">{{ $grupo->deleted_at }}</td>
                                <td class="align-middle">
                                    {{ Form::open(['route' => ['admin.grupos.forceDelete', $grupo->id], 'class' => 'confirmDelete']) }}
                                    <div class="btn-group">
                                        @can('acl.view', 'admin.grupos.restore')
                                            <a href="{{ route('admin.grupos.restore', [$grupo->id]) }}" class="btn btn-outline-info" data-toggle="tooltip" title="Restaurar">
                                                <i class="mdi mdi-delete-restore"></i> Restaurar
                                            </a>
                                        @endcan
                                        @can('acl.view', 'admin.grupos.forceDelete')
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            <button class="btn btn-danger" type="submit" data-toggle="tooltip" title="Remover da lixeira">
                                                <i class="mdi mdi-delete-forever"></i>
                                            </button>
                                        @endcan
                                    </div>
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            {{ $grupos->appends(request()->query())->links() }}
        </div>
        <div class="col-md-12">
            Página {{$grupos->currentPage()}} de {{$grupos->lastPage()}}, mostrando {{$grupos->count()}}
            resultados de {{$grupos->total()}} no total
        </div>
    </div>
@endsection

@section('css')
    <link href="{{ vAsset('idealui/assets/vendor/material-input/css/material-input.css') }}" rel="stylesheet"/>
@endsection

@section('scripts')
@endsection