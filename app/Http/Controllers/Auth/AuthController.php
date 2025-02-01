<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $validated = $request->validate ([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        Auth::login($user); 


        $token = $user->createToken('auth_token')->plainTextToken;

        // Если запрос API, вернуть JSON с токеном
        if ($request->expectsJson()) {
            return response()->json([
                'user' => $user,
                'token' => $token
            ], 200);
        }

        return redirect()->route('tasks');
        
    }

    public function login(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($validated)) {

            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
    
            // Если запрос API, вернуть JSON с токеном
            if ($request->expectsJson()) {
                return response()->json([
                    'user' => $user,
                    'token' => $token
                ], 200);
            }
    

            return redirect()->route('tasks');
        } else {

            return back()->withErrors([
                'email' => 'Неверный email или пароль.'
            ])->withInput(); 
        }
    }

    public function logout(Request $request) {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout(); 
        }
    
        if ($request->user()) {
            $request->user()->tokens()->delete(); 
        }
    
        return redirect('/login'); 
    }

}
