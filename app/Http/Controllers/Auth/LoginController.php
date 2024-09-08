<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function show()
    {
        //dd(session()->all());
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Az e-mail cím megadása kötelező!',
            'email.email' => 'Az e-mail cím formátuma hibás!',
            'password.required' => 'A jelszó megadása kötelező!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            return view('auth.login', ['success' => 'Sikeres bejelentkezés!']);
        }

        return redirect()->back()->withErrors([
            'email' => 'Hibás e-mail cím vagy jelszó.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return view('auth.login', ['success' => 'Sikeres kijelentkezés!']);
    }
}
