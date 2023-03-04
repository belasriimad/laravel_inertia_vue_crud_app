<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AuthController extends Controller
{
    //
    public function register() {
        return Inertia::render('User/Register');
    }

    public function store(Request $request) {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth()->login($user);

        $request->session()->regenerate();

        return redirect()->route('home');
    }

    public function login() {
        return Inertia::render('User/Login');
    }

    public function auth(Request $request) {
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if(auth()->attempt([
            'password' => $request->password,
            'email' => $request->email,
        ])) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }else {
            return Inertia::render('User/Login', [
                'failed' => "These credentials do not match any of our records!"
            ]);
        }
    }

    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
