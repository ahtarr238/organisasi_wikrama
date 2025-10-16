<?php

use App\Http\Controllers\DailyActivityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkPrgoramController;

// Home route
Route::get('/', function () {
    return view('home');
})->name('home');


Route::middleware('guest')->group(function() {  
    Route::get('/login', function() {
        return view('login');
    })->name('login');
    Route::post('/login', [UserController::class, 'loginAuth'])->name('login.process');
    Route::get('/signup', function() {
        return view('signup');
    })->name('sign-up');
    Route::post('/signup', [UserController::class, 'signUp'])->name('sign-up.process');
});

Route::post('/logout', [UserController::class, 'logout'])->name('logout');


Route::middleware('isAdmin')->prefix('admin')->group(function () {
    Route::get('/dashboard', function() {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
});


Route::middleware('isStaff')->prefix('/staff')->name('staff.')->group(function () {
    Route::get('/dashboard', function () {
        // Total kegiatan
        $totalKegiatan = \App\Models\DailyActivity::count();
        
        // Kegiatan aktif (status on_going)
        $kegiatanAktif = \App\Models\DailyActivity::where('status', 'on_going')->count();
        
        // Kegiatan terbaru dengan relasi user
        $kegiatanTerbaru = \App\Models\DailyActivity::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        

        return view('staff.dashboard', compact(
            'totalKegiatan',
            'kegiatanAktif',
            'kegiatanTerbaru'
        ));
    })->name('dashboard');

    Route::prefix('/activity')->name('activity.')->group(function () {
        Route::get('/', [DailyActivityController::class, 'index'])->name('index');
        Route::get('/create', [DailyActivityController::class, 'create'])->name('create');
        Route::post('/store', [DailyActivityController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [DailyActivityController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [DailyActivityController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [DailyActivityController::class, 'destroy'])->name('delete');
    });

    Route::prefix('/program')->name('program.')->group(function () {
        Route::get('/', [WorkPrgoramController::class, 'index'])->name('index');
        Route::get('/create', [WorkPrgoramController::class, 'create'])->name('create');
        Route::post('/store', [WorkPrgoramController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [WorkPrgoramController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [WorkPrgoramController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [WorkPrgoramController::class, 'destroy'])->name('delete');
    });
}); 