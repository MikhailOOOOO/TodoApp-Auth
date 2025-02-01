<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Todo;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerPolicies();

        // Определяем Gate для задач
        Gate::define('update', function ($user, Todo $todo) {
            return $user->id === $todo->user_id; 
        });

        Gate::define('delete', function ($user, Todo $todo) {
            return $user->id === $todo->user_id;  
        });
    }
}