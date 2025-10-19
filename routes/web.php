<?php

use App\Http\Controllers\DailyActivityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkProgramController;
use App\Http\Controllers\GaleryController;

// Home route



// login and signup
Route::get('/login', function () {
    return view('guest.login');
})->name('login');
Route::post('/login', [UserController::class, 'loginAuth'])->name('login.process');
Route::get('/signup', function () {
    return view('guest.signup');
})->name('sign-up');
Route::post('/signup', [UserController::class, 'signUp'])->name('sign-up.process');


Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('guest.home');
    })->name('home');

    // Galery routes
    Route::get('/galery', [GaleryController::class, 'indexGuest'])->name('galery');
    Route::get('/galery/{id}', [GaleryController::class, 'showGuest'])->name('galery.detail');
    Route::get('/galery/export', [GaleryController::class, 'export'])->name('galery.export');

    // Schedule routes
    Route::get('/jadwal-kegiatan', [DailyActivityController::class, 'indexGuest'])->name('schedule');
    Route::get('/jadwal-kegiatan/{id}', [DailyActivityController::class, 'showGuest'])->name('schedule.detail');
    Route::get('/jadwal-kegiatan/export', [DailyActivityController::class, 'export'])->name('schedule.export');


});

Route::post('/logout', [UserController::class, 'logout'])->name('logout');


Route::middleware('isAdmin')->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        // Total anggota
        $totalAnggota = \App\Models\User::count();
        
        // Total kegiatan
        $totalKegiatan = \App\Models\DailyActivity::count();
        
        // Total galeri
        $totalGaleri = \App\Models\Galery::count();
        
        // Total user
        $totalUser = \App\Models\User::count();
        
        // Kegiatan terbaru
        $kegiatanTerbaru = \App\Models\DailyActivity::orderBy('created_at', 'desc')->limit(5)->get();
        
        // Anggota aktif
        $anggotaAktif = \App\Models\User::orderBy('created_at', 'desc')->limit(5)->get();
        
        return view('admin.dashboard', compact(
            'totalAnggota',
            'totalKegiatan',
            'totalGaleri',
            'totalUser',
            'kegiatanTerbaru',
            'anggotaAktif'
        ));
    })->name('admin.dashboard');
    
    // Routes for managing anggota
    Route::resource('anggota', \App\Http\Controllers\Admin\AnggotaController::class)->names([
        'index' => 'admin.anggota.index',
        'create' => 'admin.anggota.create',
        'store' => 'admin.anggota.store',
        'show' => 'admin.anggota.show',
        'edit' => 'admin.anggota.edit',
        'update' => 'admin.anggota.update',
        'destroy' => 'admin.anggota.destroy'
    ]);
    
    // Export anggota
    Route::get('/anggota/export', [\App\Http\Controllers\Admin\AnggotaController::class, 'export'])->name('admin.anggota.export');
    
    // Routes for managing deleted anggota
    Route::get('/anggota/trash', [\App\Http\Controllers\Admin\AnggotaController::class, 'trash'])->name('admin.anggota.trash');
    Route::post('/anggota/restore/{id}', [\App\Http\Controllers\Admin\AnggotaController::class, 'restore'])->name('admin.anggota.restore');
    Route::delete('/anggota/force-delete/{id}', [\App\Http\Controllers\Admin\AnggotaController::class, 'forceDelete'])->name('admin.anggota.forceDelete');

      // Routes for managing galery
    Route::resource('galery', \App\Http\Controllers\Admin\GaleryController::class)->names([
        'index' => 'admin.galery.index',
        'create' => 'admin.galery.create',
        'store' => 'admin.galery.store',
        'show' => 'admin.galery.show',
        'edit' => 'admin.galery.edit',
        'update' => 'admin.galery.update',
        'destroy' => 'admin.galery.destroy'
    ]);
    
    // Export galeri
    Route::get('/galery/export', [\App\Http\Controllers\Admin\GaleryController::class, 'export'])->name('admin.galery.export');
    
    // Routes for managing deleted galery
    Route::get('/galery/trash', [\App\Http\Controllers\Admin\GaleryController::class, 'trash'])->name('admin.galery.trash');
    Route::post('/galery/restore/{id}', [\App\Http\Controllers\Admin\GaleryController::class, 'restore'])->name('admin.galery.restore');
    Route::delete('/galery/force-delete/{id}', [\App\Http\Controllers\Admin\GaleryController::class, 'forceDelete'])->name('admin.galery.forceDelete');
    
    // Routes for monitoring kegiatan
    Route::get('/kegiatan', [\App\Http\Controllers\MonitoringController::class, 'kegiatanIndex'])->name('admin.kegiatan.index');
    Route::get('/kegiatan/{id}', [\App\Http\Controllers\MonitoringController::class, 'kegiatanShow'])->name('admin.kegiatan.show');
    Route::delete('/kegiatan/{id}', [\App\Http\Controllers\MonitoringController::class, 'kegiatanDestroy'])->name('admin.kegiatan.destroy');
    Route::get('/kegiatan/export', [\App\Http\Controllers\MonitoringController::class, 'kegiatanExport'])->name('admin.kegiatan.export');
    
    // Routes for managing deleted kegiatan
    Route::get('/kegiatan/trash', [\App\Http\Controllers\MonitoringController::class, 'kegiatanTrash'])->name('admin.kegiatan.trash');
    Route::post('/kegiatan/restore/{id}', [\App\Http\Controllers\MonitoringController::class, 'kegiatanRestore'])->name('admin.kegiatan.restore');
    Route::delete('/kegiatan/force-delete/{id}', [\App\Http\Controllers\MonitoringController::class, 'kegiatanForceDelete'])->name('admin.kegiatan.forceDelete');
    
    // Routes for monitoring anggota
    Route::get('/anggota-monitoring', [\App\Http\Controllers\MonitoringController::class, 'anggotaIndex'])->name('admin.anggota.monitoring');
    Route::get('/anggota-detail/{id}', [\App\Http\Controllers\MonitoringController::class, 'anggotaShow'])->name('admin.anggota.detail');
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

        // Total program
        $totalProgram = \App\Models\WorkProgram::count();

        // Program aktif (status on_going)
        $programAktif = \App\Models\WorkProgram::where('status', 'on_going')->count();

        // Program terbaru dengan relasi creator
        $programTerbaru = \App\Models\WorkProgram::with('creator')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('staff.dashboard', compact(
            'totalKegiatan',
            'kegiatanAktif',
            'kegiatanTerbaru',
            'totalProgram',
            'programAktif',
            'programTerbaru'
        ));
    })->name('dashboard');

    Route::prefix('/activity')->name('activity.')->group(function () {
        Route::get('/', [DailyActivityController::class, 'index'])->name('index');
        Route::get('/create', [DailyActivityController::class, 'create'])->name('create');
        Route::post('/store', [DailyActivityController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [DailyActivityController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [DailyActivityController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [DailyActivityController::class, 'destroy'])->name('destroy');
        Route::get('/trash', [DailyActivityController::class, 'trash'])->name('trash');
        Route::post('/restore/{id}', [DailyActivityController::class, 'restore'])->name('restore');
        Route::delete('/force-delete/{id}', [DailyActivityController::class, 'forceDelete'])->name('forceDelete');
        Route::get('/export', [DailyActivityController::class, 'export'])->name('export');
    });

    Route::prefix('/program')->name('program.')->group(function () {
        Route::get('/', [WorkProgramController::class, 'index'])->name('index');
        Route::get('/create', [WorkProgramController::class, 'create'])->name('create');
        Route::post('/store', [WorkProgramController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [WorkProgramController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [WorkProgramController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [WorkProgramController::class, 'destroy'])->name('destroy');
        Route::get('/trash', [WorkProgramController::class, 'trash'])->name('trash');
        Route::post('/restore/{id}', [WorkProgramController::class, 'restore'])->name('restore');
        Route::delete('/force-delete/{id}', [WorkProgramController::class, 'forceDelete'])->name('forceDelete');
        Route::get('/export', [WorkProgramController::class, 'export'])->name('export');
    });

    Route::prefix('/galery')->name('galery.')->group(function () {
        Route::get('/', [GaleryController::class, 'index'])->name('index');
        Route::get('/create', [GaleryController::class, 'create'])->name('create');
        Route::post('/store', [GaleryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [GaleryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [GaleryController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [GaleryController::class, 'destroy'])->name('destroy');
        Route::get('/trash', [GaleryController::class, 'trash'])->name('trash');
        Route::post('/restore/{id}', [GaleryController::class, 'restore'])->name('restore');
        Route::delete('/force-delete/{id}', [GaleryController::class, 'forceDelete'])->name('forceDelete');
        Route::get('/export', [GaleryController::class, 'export'])->name('export');
    });
});

