@extends('todos.layout')

@section('content')
    <div class="flex justify-between border-b pb-4 px-4">
        <h1 class="text-3xl font-semibold">Create new todo</h1>
        <a class="mx-5 text-blue-400 py-2 cursor-pointer text-white" href="{{route('todo.index')}}"><span class="fas fa-arrow-left align-bottom" /></a>
    </div>
    <x-alert />
    <form method="POST" action="{{route('todo.store')}}" class="py-5">
        @csrf
        <div class="py-1">
            <input type="text" name="title" class="py-2 px-2 border rounded" placeholder="Title" />
        </div>
        <div class="py-1">
            <textarea name="description" class="p-2 border rounded" placeholder="Description"></textarea>
        </div>
        <div class="py-2">
            @livewire('step')
        </div>
        <div class="py-1">
            <input type="submit" value="Create" class="p-2 border rounded" />
        </div>
    </form>
@endsection

