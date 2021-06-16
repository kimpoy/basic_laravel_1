 {{-- For check icon --}}
 @if ($todo->completed)
 <span onclick="event.preventDefault();
                 document.getElementById('form-incomplete-{{ $todo->id }}')
                 .submit()" class="fas fa-check text-success" style="cursor: pointer" />
 <form style="display: none" id="{{ 'form-incomplete-' . $todo->id }}"
     action="{{ route('todo.incomplete',$todo->id) }}" method="post">
     @csrf
     @method('delete')
 </form>
 @else
 <span onclick="event.preventDefault();
                 document.getElementById('form-complete-{{ $todo->id }}')
                 .submit()" class="fas fa-check text-dark" style="cursor: pointer" />
 <form style="display: none" id="{{ 'form-complete-' . $todo->id }}"
     action="{{ route('todo.complete',$todo->id) }}" method="post">
     @csrf
     @method('put')
 </form>
 @endif
