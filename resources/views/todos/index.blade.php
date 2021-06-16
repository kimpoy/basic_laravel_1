@extends('todos.layout')

@section('content')

<x-alert />
<div class="d-flex justify-content-center">
    <table class="table table-striped mt-5" style="width: 40%;">
        <thead>
            <tr>
                <th></th>
                <th>
                    <div class="d-flex justify-content-between mb-2">
                        <h2>All Todos</h2>
                        <button class="btn" onclick="window.location.href='{{ route('todo.create') }}'">
                            <span class="fas fa-plus-square fa-2x text-primary"></span>
                        </button>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($todos as $todo)
            <tr>
                <th class="w-25">@include('todos.complete')</th>
                {{-- For title text --}}
                @if ($todo->completed)
                <th lass="w-75"><del>{{ $todo->title }}</del></th>
                @else
                <th lass="w-75">{{ $todo->title }}</th>
                @endif

                <th class="w-25">
                    {{-- Edit Button --}}
                    <a href="{{ route('todo.edit', $todo->id) }}" class="btn text-secondary">
                        <span class="fas fa-edit fa-lg" />
                    </a>

                    {{-- Delete Button --}}
                    <span class="fas fa-trash fa-lg text-danger"
                    onclick="event.preventDefault();
                    if(confirm('You want to delete Todo?')){
                        document.getElementById('form-delete-{{ $todo->id }}')
                        .submit()
                    }"style="cursor: pointer" />
                    <form style="display: none" id="{{ 'form-delete-' . $todo->id }}"
                        action="{{ route('todo.destroy',$todo->id) }}" method="post">
                        @csrf
                        @method('delete')
                    </form>

                </th>
            </tr>
            @empty
            <tr>
                <th colspan="1"></th>
                <th class="w-75">
                        <p>No Task Available, Create one</p>
                </th>
            </tr>
            @endforelse

        </tbody>
    </table>
</div>

@endsection
