<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoCreateRequest;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // dd(\auth()->user()->todos);
        //!return users todos
        //* orderby using sql
        // $todos = auth()->user()->todos()->orderBy('completed', 'desc')->get();

        //*sortby using collection

        $todos = \auth()->user()->todos->sortbyDesc('completed');

        //!return all todos
        // $todos = Todo::orderBy('completed', 'desc')->get();
        // $todos = Todo::all();


        //* Using compact rather than with()
        return view('todos.index', \compact('todos'));
        // return view('todos.index')->with(['todos' => $todos]);
    }

    public function create()
    {
        return view('todos.create');
    }

    //we use TodoCreateRequest Controller using make:request TodoCreateRequest rather than Request to minimize codes
    public function store(TodoCreateRequest $request)
    {
        /* $request->validate([
            'title' => 'required|max:255',
        ]); */

        // $rules = [
        //     'title' => 'required|max:255',
        // ];
        // $message = [
        //    e
        // ];

        // //* Custom validation error
        // $validator = Validator::make($request->all(), $rules, $message);
        // if ($validator->fails()) {
        //     return \redirect()->back()->withErrors($validator)->withInput();
        // }

        //!has many relationshit save user_id
        $userId = \auth()->id();
        $request['user_id'] = $userId;

        // \auth()->user()todos()->create($request->all());
        Todo::create($request->all());
        return \redirect(\route('todo.index'))->with('message', 'Todo created!');
    }

    public function edit(Todo $todo)
    {
        // \dd($todo->title);
        // $todo = Todo::find($id);
        return view('todos.edit', \compact('todo'));
    }

    // public function edit($id)
    // {
    //     $todo = Todo::find($id);
    //     return view('todos.edit', \compact('todo'));
    // }

    public function update(TodoCreateRequest $request, Todo $todo)
    {
        // \dd($request->all());
        $todo->update(['title' => $request->title]);
        // return \redirect()->back()->with('message', 'Update!');
        return \redirect(\route('todo.index'))->with('message', 'Updated!'); //redirect to index page
    }

    //! for complete and incomplete todo
    public function complete(Todo $todo)
    {
        $todo->update(['completed' => true]);
        return \redirect()->back()->with('message', 'Task Marked as Completed');
    }

    public function incomplete(Todo $todo)
    {
        $todo->update(['completed' => false]);
        return \redirect()->back()->with('message', 'Task Marked as Incompleted');
    }

    //! for delete

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return \redirect()->back()->with('message', 'Task Deleted!');
    }
}
