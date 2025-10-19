<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DailyActivity;
use App\Exports\KegiatanExport;
use Maatwebsite\Excel\Facades\Excel;

class MonitoringController
{
    /**
     * Display a listing of kegiatan.
     */
    public function kegiatanIndex()
    {
        $kegiatans = DailyActivity::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.kegiatan.index', compact('kegiatans'));
    }

    /**
     * Display the specified kegiatan.
     */
    public function kegiatanShow($id)
    {
        $kegiatan = DailyActivity::with('user')->findOrFail($id);
        return view('admin.kegiatan.show', compact('kegiatan'));
    }

    /**
     * Display a listing of anggota.
     */
    public function anggotaIndex()
    {
        $anggotas = User::orderBy('created_at', 'desc')->get();
        return view('admin.anggota.monitoring', compact('anggotas'));
    }

    /**
     * Display the specified anggota.
     */
    public function anggotaShow($id)
    {
        $anggota = User::with('dailyActivities')->findOrFail($id);
        return view('admin.anggota.detail', compact('anggota'));
    }
    
    /**
     * Remove the specified kegiatan from storage.
     */
    public function kegiatanDestroy($id)
    {
        $kegiatan = DailyActivity::findOrFail($id);
        
        $delete = $kegiatan->delete();
        
        if ($delete) {
            return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus kegiatan, silakan coba lagi');
        }
    }

    /**
     * Export data kegiatan to Excel
     */
    public function kegiatanExport()
    {
        return Excel::download(new KegiatanExport, 'data-kegiatan-' . date('Y-m-d') . '.xlsx');
    }
    
    /**
     * Display a listing of deleted kegiatan.
     */
    public function kegiatanTrash()
    {
        $kegiatans = DailyActivity::onlyTrashed()->with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.kegiatan.trash', compact('kegiatans'));
    }
    
    /**
     * Restore the specified kegiatan from storage.
     */
    public function kegiatanRestore($id)
    {
        $kegiatan = DailyActivity::onlyTrashed()->findOrFail($id);
        $kegiatan->restore();
        
        return redirect()->route('admin.kegiatan.trash')->with('success', 'Kegiatan berhasil dikembalikan!');
    }
    
    /**
     * Force delete the specified kegiatan from storage.
     */
    public function kegiatanForceDelete($id)
    {
        $kegiatan = DailyActivity::onlyTrashed()->findOrFail($id);
        $kegiatan->forceDelete();
        
        return redirect()->route('admin.kegiatan.trash')->with('success', 'Kegiatan berhasil dihapus permanen!');
    }
}
