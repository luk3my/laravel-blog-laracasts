<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('success', 'User Logged out.');
    }

    public function create()
    {
        return view('createSession');
    }

     public function store()
    {
        $attr = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],  
        ]);
        
        if (auth()->attempt($attr)) {
            session()->regenerate();
            return redirect('/')->with('success', 'Welcome Back.');
        }

        throw ValidationException::withMessages([
            'email' => 'User credentials could not be validated.'
        ]);

        // return back()
        //     ->withInput()
        //     ->withErrors(['email' => 'User credentials could not be validated.']);
    }
}
