<?php

namespace App\Http\Controllers;

use App\Models\DailyActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ScheduleController extends Controller
{
    /**
     * Menampilkan halaman jadwal kegiatan untuk pengunjung
     */
    public function index()
    {
        // Mengambil semua kegiatan, diurutkan berdasarkan tanggal terbaru
        $events = DailyActivity::orderBy('date', 'desc')->get();

        return view('guest.schedule', compact('events'));
    }

    /**
     * Menampilkan detail kegiatan tertentu
     */
    public function show($id)
    {
        $event = DailyActivity::findOrFail($id);

        return view('guest.schedule-detail', compact('event'));
    }
}   

