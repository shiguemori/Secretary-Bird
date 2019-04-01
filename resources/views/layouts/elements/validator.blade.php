@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-important alert-danger alert-dismissible border-0 fade show col-12" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            {{ $error }}
        </div>
    @endforeach
@endif