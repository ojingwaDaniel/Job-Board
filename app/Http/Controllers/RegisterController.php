<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function create()
    {
        return view("register.create");
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => 'required|min:3',
            "email" => 'required|email|unique:users,email',
            "password" => 'required|min:8|confirmed',


        ]);
        $user = User::create([
            "name" => $validatedData['name'],
            'email' => $validatedData['email'],
            "password" => Hash::make($validatedData['password'])
        ]);
        Auth::login($user);
        $request->session()->regenerate();
        event(new Registered($user));
       return redirect()->route("verification.notice");
    }
}
