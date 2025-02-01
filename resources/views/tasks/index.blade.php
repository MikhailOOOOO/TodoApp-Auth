@extends('layouts.app')

@section('content')

<h1>Task List</h1>

@foreach($todos as $todo)
    <div class="card @if($todo->isCompleted()) border-success @endif" style="margin-bottom: 20px;">
        <div class="card-body d-grid gap-2">
            <p>{{ $todo->description }}</p>
            
            @if(!$todo->isCompleted())
                <form action="/tasks/{{ $todo->id }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-secondary" type="submit">Complete</button>
                    </div>
                </form>
            @else
                <form action="/tasks/{{ $todo->id }}" method="POST">
                    @method('DELETE')
                    @csrf 
                    <div class="d-grid gap-2">
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endforeach

<a href="/tasks/create" class="btn btn-primary btn-lg d-grid gap-2">New Task</a>

@endsection