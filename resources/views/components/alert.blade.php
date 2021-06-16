<div>
    @if (session()->has('message'))
        <div class="alert alert-success fade show text-center m-auto w-50">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4>{{ session()->get('message') }}</h4>
        </div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger fade show text-center m-auto w-50">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4>{{ session()->get('error') }}</h4>
        </div>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger fade show text-center m-auto w-50 ">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4>{{ $error }}</h4>
            </div>
        @endforeach
    @endif
</div>
