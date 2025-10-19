<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyActivity;
use App\Models\WorkProgram;

class StaffController extends Controller
{
    public function dashboard()
    {
        // Total kegiatan
        $totalKegiatan = DailyActivity::count();

        // Kegiatan aktif (status on_going)
        $kegiatanAktif = DailyActivity::where('status', 'on_going')->count();

        // Kegiatan terbaru dengan relasi user
        $kegiatanTerbaru = DailyActivity::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Total program
        $totalProgram = WorkProgram::count();

        // Program aktif (status on_going)
        $programAktif = WorkProgram::where('status', 'on_going')->count();

        // Program terbaru dengan relasi creator
        $programTerbaru = WorkProgram::with('creator')
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
    }
}
