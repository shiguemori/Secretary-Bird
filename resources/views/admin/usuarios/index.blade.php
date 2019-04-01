@extends('layouts.master')

@section('h1', 'Usuários/Clientes')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="toolbar row mb-3">
                <form action="" method="get" class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                    @include('admin.elements.filters.searchbar')
                </form>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-1">
                    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-outline-danger btn-toolbar addAction text-uppercase d-block" data-toggle="tooltip" title="Limpar pesquisa">
                        <i class="mdi mdi-filter-remove"></i>
                    </a>
                </div>
                @can('acl.view', 'admin.usuarios.create')
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
                        <a href="{{ route('admin.usuarios.create') }}" class="btn btn-outline-success btn-toolbar addAction text-uppercase d-block" data-toggle="tooltip" title="Novo">
                            <i class="mdi mdi-note-plus-outline mr-2"></i> <span class="hidden-xs hidden-sm">Novo</span>
                        </a>
                    </div>
                @endcan

                @can('acl.view', 'admin.usuarios.trashed')
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-1">
                        <a href="{{ route('admin.usuarios.trashed') }}" class="btn btn-outline-secondary btn-toolbar addAction text-uppercase d-block" data-toggle="tooltip" title="Lixeira">
                            <i class="mdi mdi-delete-outline noti-icon"></i>
                        </a>
                    </div>
                @endcan
            </div>
            <div class="card-box">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td class="align-middle">{{ $usuario->id }}</td>
                                <td class="align-middle" nowrap>{{ $usuario->getFullName() }}</td>
                                <td class="align-middle">{{ $usuario->email }}</td>
                                <td class="align-middle">{{ $usuario->status()->first()->titulo }}</td>
                                <td class="align-middle text-right">
                                    {{ Form::open(['route' => ['admin.usuarios.destroy', $usuario->id], 'class' => 'confirmDelete']) }}
                                    <div class="btn-group">
                                        @can('acl.view', 'admin.usuarios.edit')
                                            <a href="{{route('admin.usuarios.edit', $usuario->id)}}" class="btn btn-outline-primary" data-toggle="tooltip" title="Editar"><i class="mdi mdi-pencil"></i></a>
                                        @endcan
                                        @can('acl.view', 'admin.usuarios.destroy')
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            <button class="btn btn-danger" type="submit" data-toggle="tooltip" title="Remover">
                                                <i class="mdi mdi-delete"></i>
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
    <div class="row mb-5">
        <div class="col-md-12">{{ $usuarios->appends(request()->query())->links() }}</div>
        <div class="col-md-12">
            Página {{$usuarios->currentPage()}} de {{$usuarios->lastPage()}},
            mostrando {{$usuarios->count()}} resultados de {{$usuarios->total()}} no total
        </div>
    </div>
@endsection

@section('css')
    <link href="{{ vAsset('idealui/assets/vendor/material-input/css/material-input.css') }}" rel="stylesheet"/>
@endsection

@section('scripts')
@endsection