<html>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Выйти</button>
    </form>
    <head>
        <title>Todo App Demo</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' />
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('tasks') }}">Stackcasts Todo App Demo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('tasks') }}">All Tasks</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{ url('/tasks/create') }}">New Task</a>
                </li>
            </ul>
            </div>
        </div>
        </nav>

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>  