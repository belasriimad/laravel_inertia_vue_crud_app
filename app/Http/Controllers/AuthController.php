<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    //
    public function register() {
        return Inertia::render('User/Register');
    }

    public function store(Request $request) {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        
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

    public function profile() {
        return Inertia::render('User/Profile');
    }

    public function updateProfileImage(Request $request) {
        $this->validate($request,[
            'photo_url' => 'mimes:jpg,png,jpeg,webp|max:2000',
        ]);

        if(Storage::disk('public')->exists(auth()->user()->photo_url)) {
            Storage::disk('public')->delete(auth()->user()->photo_url);
        }

        $file = $request->file('photo_url');
        $path = $file->store('profiles', 'public');


        auth()->user()->update([
            'photo_url' => $path
        ]);

        return redirect()->route('profile')->with([
            'message' => 'Image uploaded successfully',
            'class' => 'alert alert-success'
        ]);
    }

    public function emailVerification() {
        if(auth()->user()->hasVerifiedEmail()) {
            return redirect()->back();
        }
        return Inertia::render('User/VerifyEmail');
    }

    public function getNotifications() {
        return Inertia::render('User/Notifications')->with([
            'notifications' => auth()->user()->notifications
        ]);
    } 

    public function markNotificationAsRead($id) {
        auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
        return redirect()->route('notifications')->with([
            'message' => 'Notification marked as read successfully',
            'class' => 'alert alert-success'
        ]);
    }
}
