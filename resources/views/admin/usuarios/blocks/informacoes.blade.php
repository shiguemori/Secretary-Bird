<h5 class="header-title">Informações</h5>

<div class="col-12">
    <div class="row">
        <div class="col-5">
            <div class="form-group">
                {{ Form::label('nome', 'Nome *') }}
                {{ Form::text('nome', null, [
                    'id' => "nome",
                    'placeholder' => "Insira o Nome do usuário",
                    'class' => "form-control"
                ]) }}
            </div>
        </div>
        <div class="col-7">
            <div class="form-group">
                {{ Form::label('sobrenome', 'Sobrenome *') }}
                {{ Form::text('sobrenome', null, [
                    'id' => "sobrenome",
                    'placeholder' => "Insira o Sobrenome do usuário",
                    'class' => "form-control"
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="form-group">
                {{ Form::label('email', 'Email *') }}
                {{ Form::email('email', null, [
                    'id' => "email",
                    'placeholder' => "Insira o Email do usuário",
                    'class' => "form-control"
                ]) }}
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                {{ Form::label('status_id', 'Status *') }}
                {{ Form::select('status_id', $status, null, [
                    'id' => 'status_id',
                    'class' => 'select2-cont',
                    'placeholder' => '-- Selecione --'
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="form-group">
                {{ Form::label('password', 'Senha *') }}
                {{ Form::password('password', [
                    'id' => "password",
                    'placeholder' => "Insira o Senha do usuário",
                    'class' => "form-control"
                ]) }}
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                {{ Form::label('password_confirmation', 'Confirmação da senha *') }}
                {{ Form::password('password_confirmation', [
                    'id' => "password_confirmation",
                    'placeholder' => "Repita a Senha do usuário",
                    'class' => "form-control"
                ]) }}
            </div>
        </div>
    </div>
</div>