@if (session()->has('message'))
    <div class="alert alert-success">{{ session()->get('message') }}</div>
@elseif (session()->has('error'))
    <div class="alert alert-danger">{{ session()->get('error') }}</div>
@endif

@if ($errors->any())
{!! implode('',$errors->all('<div class="alert alert-danger">:message</div>')) !!}
@endif

