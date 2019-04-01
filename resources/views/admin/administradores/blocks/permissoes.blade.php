@can('acl.view', 'admin.administradores.edit')
    <fieldset class='permissoes'>
        <div class="card-box">
            <h5 class="header-title">Permissões de acesso</h5>
            <div class="col-12">
                <table class="table table-hover table-striped" id="thegrid">
                    <tbody>
                    @foreach($permissoes as $id => $permissao)
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-1 text-center">
                                        {{ Form::checkbox("permissoes[{$id}]", true, $permissao['ativo'], [
                                            'id' => "permissoes[{$id}]",
                                            'class' => 'permission',
                                            'data-plugin' => "switchery",
                                            'data-color' => "#1bb99a",
                                            'data-switchery' => "true",
                                            'data-size' => 'small',
                                            'data-id' => $id
                                        ]) }}
                                    </div>
                                    <div class="col-11">
                                        <i class="{!! $permissao['icone'] !!}"></i> {!! Form::label('permissoes['.$id.']', $permissao['nome']) !!}
                                    </div>
                                </div>

                                @foreach($permissao['childs'] as $child_id => $child)
                                    <div class="row mt-2">
                                        <div class="col-1 text-center offset-1">
                                            {{ Form::checkbox('permissoes['.$child_id.']', true, $child['ativo'], [
                                                'id' => "permissoes[{$child_id}]",
                                                'class' => 'permission',
                                                'data-plugin' => "switchery",
                                                'data-color' => "#1bb99a",
                                                'data-switchery' => "true",
                                                'data-size' => 'small',
                                                'data-parent' => $id
                                            ]) }}
                                        </div>
                                        <div class="col-10">
                                            {!! Form::label("permissoes[{$child_id}]", $child['nome']) !!}&nbsp;&nbsp;
                                        </div>
                                    </div>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </fieldset>
@endcan
