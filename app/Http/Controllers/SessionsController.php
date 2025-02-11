<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (! auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials are incorrect.'
            ]);
        }

        session()->regenerate();

        return redirect('/')->with('success', 'You are now logged in');
    }
    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Successfully logged out');
    }
}
