<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function() {
    Route::get('/', [TaskController::class, 'index'])->name('home');
    Route::resource('/tasks', TaskController::class)->middleware('verified')
        ->except(['index', 'getTasksByCategory' , 'getTasksOrderedBy', 'getTasksByTerm']);
    Route::get('category/{category}/tasks',[TaskController::class, 'getTasksByCategory'])->name('category.tasks');
    Route::get('search/tasks', [TaskController::class, 'getTasksByTerm'])->name('search.tasks');
    Route::get('order/{column}/{direction}/tasks',[TaskController::class, 'getTasksOrderedBy'])->name('order.tasks');
    Route::post('user/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('user/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('user/profile', [AuthController::class, 'updateProfileImage'])->name('profile');
    Route::get('user/notifications', [AuthController::class, 'getNotifications'])->name('notifications');
    Route::get('read/{id}/notification', [AuthController::class, 'markNotificationAsRead'])->name('read.notification');
    Route::get('/email/verify', [AuthController::class, 'emailVerification'])->middleware('auth')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
     
        return redirect()->route('home')->with([
            'message' => 'Email verified successfully',
            'class' => 'alert alert-success'
        ]);
    })->middleware('signed')->name('verification.verify');
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
     
        return redirect()->back()->with([
            'message' => 'Verification link sent!',
            'class' => 'alert alert-success'
        ]);
    })->middleware('throttle:6,1')->name('verification.send');
});

Route::middleware('guest')->group(function() {
    Route::get('user/register', [AuthController::class, 'register'])->name('register');
    Route::post('user/register', [AuthController::class, 'store'])->name('register');
    Route::get('user/login', [AuthController::class, 'login'])->name('login');
    Route::post('user/login', [AuthController::class, 'auth'])->name('login');
});


