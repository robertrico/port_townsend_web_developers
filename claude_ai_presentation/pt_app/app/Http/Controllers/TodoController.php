<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Http\Requests\StoreTodoRequest;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::orderBy('priority', 'desc')
            ->orderBy('completed', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('todos.index', compact('todos'));
    }

    public function store(StoreTodoRequest $request)
    {
        Todo::create($request->validated());

        return redirect()->route('todos.index')->with('success', 'Todo created successfully!');
    }

    public function toggle(Todo $todo)
    {
        $todo->update(['completed' => !$todo->completed]);

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('todos.index');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('todos.index')->with('success', 'Todo deleted successfully!');
    }

    public function apiIndex()
    {
        $todos = Todo::orderBy('priority', 'desc')
            ->orderBy('completed', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($todos);
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|unique:todos,title',
            'description' => 'nullable',
            'priority' => 'required|in:low,medium,high',
        ]);

        $todo = Todo::create($validated);

        return response()->json($todo, 201);
    }
}
