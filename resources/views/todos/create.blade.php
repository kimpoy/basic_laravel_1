@extends('todos.layout')

@section('content')
<x-alert />
<form class="form-container d-flex flex-column align-items-center mt-5 border rounded mr-auto ml-auto w-25 shadow p-3 mb-5 bg-white rounded" action="{{ route('todo.store') }}" method="post">
    <div class="d-flex justify-content-between align-items-center mb-2" style="width: 70%;">
        <h1>Create Todo</h1>
        <a href="{{ route('todo.index') }}"><span class="fas fa-arrow-left fa-2x text-info"></span></a>
    </div>
    @csrf
    <div class="form-group">
        <input type="text" name="title" />
        <input type="submit" class="btn btn-primary ml-1" value="Create" />
    </div>
</form>
@endsection
