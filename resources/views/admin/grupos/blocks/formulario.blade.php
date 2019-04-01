<h5 class="header-title">Título</h5>

<div class="col-12">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                {{ Form::label('titulo', 'Nome do Grupo *') }}
                {{ Form::text('titulo', null, [
                    'id' => "titulo",
                    'placeholder' => "Insira o Nome do grupo",
                    'class' => "form-control form-control-lg"
                ]) }}
            </div>
        </div>
    </div>
</div>