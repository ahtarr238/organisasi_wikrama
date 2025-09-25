<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('home');
});

Route::get('login', function () {
    return view('login');
})->name('login');

Route::post('login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    $remember = $request->has('remember');

    if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah',
    ])->withInput($request->except('password'));
})->name('login.process');



Route::get('signup', function () {
    return view('signup');
})->name('sign-up');

Route::post('signup', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8'], // removed 'confirmed'
        'gender' => ['required', 'in:L,P'],
        'birth_date' => ['required', 'date'],
        'address' => ['required', 'string'],
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'gender' => $validated['gender'],
        'birth_date' => $validated['birth_date'],
        'address' => $validated['address'],
    ]);

    Auth::login($user);

    return redirect('/')->with('success', 'Akun anda sudah terbuat dengan sukses!');
})->name('sign-up.process');

Route::post('logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');
