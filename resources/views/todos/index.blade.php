@extends('todos.layout')

@section('content')
    <div class="flex justify-between border-b pb-4 px-4">
        <h1 class="text-3xl font-semibold">Todo List</h1>
        <a class="mx-5 text-green-400 py-2 cursor-pointer text-white" href="{{route('todo.create')}}"><span class="fas fa-plus-circle align-bottom" /></a>
    </div>
    <ul class="my-5">
        <x-alert />
        @forelse($todos as $todo)
        <li class="flex justify-between py-2 px-2 hover:bg-blue-100">
            <div>
                @include('todos.completeButton')
            </div>
            @if($todo->completed)
                <p class="line-through break-all">{{$todo->title}}</p>
            @else
                <a class="cursor-pointer break-all" href="{{route('todo.show', $todo->id)}}">{{$todo->title}}</a>
            @endif
            <div>
                <a href="{{route('todo.edit', $todo->id)}}" class="text-orange-400 cursor-pointer text-white">
                    <span class="fas fa-edit px-2" />
                </a>
                <span class="fas fa-trash text-red-500 px-2 cursor-pointer"
                    onclick="
                        event.preventDefault();
                        if(confirm('Are you really want to delete this todo?')) {
                            document.getElementById('form-destroy-{{$todo->id}}')
                            .submit()
                        }"/>
                    <form class="hidden" id="{{'form-destroy-'.$todo->id}}" method="post" action="{{route('todo.destroy', $todo->id)}}">
                        @csrf
                        @method('delete')
                    </form>
            </div>
        </li>
        @empty
            <p>No task available</p>
        @endforelse
    </ul>
@endsection

