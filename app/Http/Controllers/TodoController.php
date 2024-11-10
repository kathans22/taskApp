<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;



class TodoController extends Controller
{
    public function index()
    {
        // $todos = Todo::all();

        // return view('todos.index', ['todos' => $todos]);

        $todos = Todo::where('user_id', auth()->id())->get();

        return view('todos.index', ['todos' => $todos]);




        //return view('todos.index');
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(TodoRequest $request)
    {
        // Todo::create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'is_Completed' => 0
        // ]);

        //--------------------------------------------

        // Todo::create([
        //     'title' => $request->input('title'),
        //     'description' => $request->input('description'),
        //     'is_completed' => $request->input('is_completed', false), // Set default value if not provided
        // ]);


        // $request->session()->flash('alert-success','Todo Created Succesfully');

        // return to_route('todos.index');


        //-------------------------------------------------

        Todo::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'is_completed' => $request->input('is_completed', false),
            'user_id' => auth()->id(), // Associate the todo with the current user
        ]);

        $request->session()->flash('alert-success', 'Todo Created Successfully');

        return to_route('todos.index');


    }


    // public function show($id)
    // {
    //     $todo = Todo::find($id);

    //     if(!$todo)
    //     {
    //         request()->session()->flash('error','Unable to locate the Todo');

    //         return to_route('todos.index')->withErrors([

    //             'error' => 'Unable to locate the Todo'

    //         ]);
    //     }

    //     return view('todos.show', ['todo' => $todo]);
    // }

    // public function edit($id)
    // {
    //     $todo = Todo::find($id);

    //     if(!$todo)
    //     {
    //         request()->session()->flash('error','Unable to locate the Todo');

    //         return to_route('todos.index')->withErrors([

    //             'error' => 'Unable to locate the Todo'

    //         ]);
    //     }

    //     return view('todos.edit', ['todo' => $todo]);
    // }


    // public function update(TodoRequest $request)
    // {
    //     $todo = Todo::find($request->todo_id);

    //     if(!$todo)
    //     {

    //         request()->session()->flash('error','Unable to locate the Todo');


    //         return to_route('todos.index')->withErrors([

    //             'error' => 'Unable to locate the Todo'

    //         ]);
    //     }

    //     $todo->update([
    //         'title' => $request->title,
    //         'description' => $request->description,
    //         'is_completed' => $request->is_completed
    //     ]);

    //     $request->session()->flash('alert-info','Todo Updated Succesfully');

    //     return to_route('todos.index');;


    // }

    // public function destroy(Request $request)
    // {
    //     $todo = Todo::find($request->todo_id);

    //     if(!$todo)
    //     {

    //         request()->session()->flash('error','Unable to locate the Todo');


    //         return to_route('todos.index')->withErrors([

    //             'error' => 'Unable to locate the Todo'

    //         ]);
    //     }

    //     $todo->delete();

    //     $request->session()->flash('alert-success', 'todos deleted successfully');
    //     return to_route('todos.index');

    // }






    //-------------------------------------------

    public function show($id)
{
    $todo = Todo::where('id', $id)->where('user_id', auth()->id())->first();

    if (!$todo) {
        request()->session()->flash('error', 'Unable to locate the Todo');
        return to_route('todos.index')->withErrors(['error' => 'Unable to locate the Todo']);
    }

    return view('todos.show', ['todo' => $todo]);
}

public function edit($id)
{
    $todo = Todo::where('id', $id)->where('user_id', auth()->id())->first();

    if (!$todo) {
        request()->session()->flash('error', 'Unable to locate the Todo');
        return to_route('todos.index')->withErrors(['error' => 'Unable to locate the Todo']);
    }

    return view('todos.edit', ['todo' => $todo]);
}

public function update(TodoRequest $request)
{
    $todo = Todo::where('id', $request->todo_id)->where('user_id', auth()->id())->first();

    if (!$todo) {
        request()->session()->flash('error', 'Unable to locate the Todo');
        return to_route('todos.index')->withErrors(['error' => 'Unable to locate the Todo']);
    }

    $todo->update([
        'title' => $request->title,
        'description' => $request->description,
        'is_completed' => $request->is_completed
    ]);

    $request->session()->flash('alert-info', 'Todo Updated Successfully');
    return to_route('todos.index');
}

public function destroy(Request $request)
{
    $todo = Todo::where('id', $request->todo_id)->where('user_id', auth()->id())->first();

    if (!$todo) {
        request()->session()->flash('error', 'Unable to locate the Todo');
        return to_route('todos.index')->withErrors(['error' => 'Unable to locate the Todo']);
    }

    $todo->delete();
    $request->session()->flash('alert-success', 'Todo Deleted Successfully');
    return to_route('todos.index');
}


}
