<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoCreateRequest;
use App\Step;
use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $todos = auth()->user()->todos->sortBy('completed');
        return view('todos.index', compact('todos'));
    }

    public function create() {
        return view('todos.create');
    }

    public function edit(Todo $todo) {
        return view('todos.edit', compact('todo'));
    }

    public function store(TodoCreateRequest $request) {
        $todo = auth()->user()->todos()->create($request->all());
        if($request->step) {
            foreach($request->step as $step) {
                $todo->steps()->create(['name' => $step]);
            }
        }
        return redirect(route('todo.index'))->with('message', 'Todo created succesfully');
    }

    public function update(TodoCreateRequest $request, Todo $todo) {
        if($request->stepName) {
            foreach($request->stepName as $key => $value) {
                $id = $request->stepId[$key];
                if(!$id) {
                    $todo->steps()->create(['name' => $value]);
                } else {
                    $step = Step::find($id);
                    $step->update(['name' => $value]);
                }
            }
        }
        $todo->update(['title' => $request->title]);
        return redirect(route('todo.index'))->with('message', 'Updated');
    }

    public function complete(Todo $todo) {
        $todo->update(['completed' => true]);
        return redirect()->back()->with(['message' =>'Task completed']);
    }

    public function incomplete(Todo $todo) {
        $todo->update(['completed' => false]);
        return redirect()->back()->with(['message' =>'Task incompleted']);
    }

    public function destroy(Todo $todo) {
        $todo->steps->each->delete();
        $todo->delete();
        return redirect()->back()->with(['message' =>'Task deleted']);
    }

    public function show(Todo $todo) {
        return view('todos.show', compact('todo'));
    }
}
