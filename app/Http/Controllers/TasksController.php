<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Gate;

class TasksController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $todos = auth()->user()->todos()->latest()->get();

        //return response()->json($todos);
        
        return view('tasks.index', compact('todos'));
    }

    public function create() {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => ['required', 'string', 'max:255']
        ]);

        $todo = auth()->user()->todos()->create($validated);
    
        return redirect('/tasks');
    }

    public function update($id)
    {   

        $todo = Todo::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        if (Gate::denies('update', $todo)) {
            return redirect('/tasks')->with('error', 'You are not authorized to update this todo');
        }

        $todo->completed_at = now();
        $todo->save();
        
        return redirect('/tasks');
    }
    
    public function delete($id)
    {

        $todo = Todo::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        if (Gate::denies('delete', $todo)) {
            return redirect('/tasks')->with('error', 'You are not authorized to update this todo');
        }
    
        $todo->delete();
    
        return redirect('/tasks');
    }
}