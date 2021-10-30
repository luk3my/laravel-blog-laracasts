<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\User;

class RegisterController extends Controller
{
    public function create() {
        return view('create');
    }

    public function store() {
        $attr = request()->validate([
            'name' => ['required', 'max:255'],
            'username' => ['required', 'max:255', 'min:3', 'unique:users,username'],
            'email' => ['required','email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:7'],  
        ]);

        $user = User::create($attr);

        // Log user in
        auth()->login($user);


        return redirect('/')->with('success', 'Your account has been created.');
    }
}
