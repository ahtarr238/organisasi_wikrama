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

class ScheduleController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
