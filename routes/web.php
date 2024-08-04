<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/dashboard', function () {
    $users = App\Models\User::where('id', '!=', auth()->user()->id)->get();
    return view("dashboard", [
        'users' => $users
    ]);
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/chat/{id}', function ($id) {
    return view("chat", [
        'id' => $id
    ]);
})
    ->middleware(['auth', 'verified'])
    ->name('chat');


Route::get('/messenger', function () {
    return view("messenger");
})
    ->middleware(['auth', 'verified'])
    ->name('messenger');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
