@if($todo->completed)
<span onclick="event.preventDefault();document.getElementById('form-incompleted-{{$todo->id}}').submit()"
    class="fas fa-check text-green-400 px-2 cursor-pointer" />
        <form class="hidden" id="{{'form-incompleted-'.$todo->id}}" method="post" action="{{route('todo.incomplete', $todo->id)}}">
            @csrf
            @method('delete')
        </form>
@else
<span onclick="event.preventDefault();document.getElementById('form-completed-{{$todo->id}}').submit()"
    class="fas fa-check text-gray-300 px-2 cursor-pointer" />
        <form class="hidden" id="{{'form-completed-'.$todo->id}}" method="post" action="{{route('todo.complete', $todo->id)}}">
            @csrf
            @method('put')
        </form>
@endif
