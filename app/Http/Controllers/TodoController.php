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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Support\Facades\View
     */
    public function index() {
        $todos = auth()->user()->todos->sortBy('completed');
        return view('todos.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Support\Facades\View
     */
    public function create() {
        return view('todos.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $todo
     * @return \Illuminate\Support\Facades\View
     */
    public function edit(Todo $todo) {
        return view('todos.edit', compact('todo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(TodoCreateRequest $request) {
        $todo = auth()->user()->todos()->create($request->all());
        if($request->step) {
            foreach($request->step as $step) {
                $todo->steps()->create(['name' => $step]);
            }
        }
        return redirect(route('todo.index'))->with('message', 'Todo created succesfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $todo
     * @return \Illuminate\Routing\Redirector
     */
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

    /**
     * Mark to do as completed.
     *
     * @param  int  $todo
     * @return \Illuminate\Routing\Redirector
     */
    public function complete(Todo $todo) {
        $todo->update(['completed' => true]);
        return redirect()->back()->with(['message' =>'Task completed']);
    }

    /**
     * Mark to do as incompleted.
     *
     * @param  int  $todo
     * @return \Illuminate\Routing\Redirector
     */
    public function incomplete(Todo $todo) {
        $todo->update(['completed' => false]);
        return redirect()->back()->with(['message' =>'Task incompleted']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $todo
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Todo $todo) {
        $todo->steps->each->delete();
        $todo->delete();
        return redirect()->back()->with(['message' =>'Task deleted']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $todo
     * @return \Illuminate\Support\Facades\View
     */
    public function show(Todo $todo) {
        return view('todos.show', compact('todo'));
    }
}
