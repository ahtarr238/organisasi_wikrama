<?php

namespace App\Http\Controllers;

use App\Models\WorkProgram;
use App\Models\User;
use App\Exports\WorkProgramExportNew as WorkProgramExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class WorkProgramController
{
    public function index()
    {
        $programs = WorkProgram::all();
        return view('staff.program.index', compact('programs'));
    }

    public function create()
    {
        return view('staff.program.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_program' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after:tgl_mulai',
            'status' => 'required|in:on_going,completed,cancelled',
        ]);

        $program = new WorkProgram();
        $program->organization_id = auth()->user()->organization_id;
        $program->nama_program = $request->nama_program;
        $program->deskripsi = $request->deskripsi;
        $program->tgl_mulai = $request->tgl_mulai;
        $program->tgl_selesai = $request->tgl_selesai;
        $program->status = $request->status;
        $program->created_by = auth()->user()->id;
        $program->save();

        return redirect()->route('staff.program.index')->with('success', 'Program kerja berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $program = WorkProgram::findOrFail($id);
        return view('staff.program.edit', compact('program'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_program' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after:tgl_mulai',
            'status' => 'required|in:on_going,completed,cancelled',
        ]);

        $program = WorkProgram::findOrFail($id);
        $program->nama_program = $request->nama_program;
        $program->deskripsi = $request->deskripsi;
        $program->tgl_mulai = $request->tgl_mulai;
        $program->tgl_selesai = $request->tgl_selesai;
        $program->status = $request->status;
        $program->save();

        return redirect()->route('staff.program.index')->with('success', 'Program kerja berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $program = WorkProgram::findOrFail($id);
        $program->delete();

        return redirect()->route('staff.program.index')->with('success', 'Program kerja berhasil dihapus!');
    }

    /**
     * Menampilkan data yang dihapus
     */
    public function trash()
    {
        $programs = WorkProgram::onlyTrashed()->get();
        return view('staff.program.trash', compact('programs'));
    }
    
    /**
     * Mengembalikan data yang dihapus
     */
    public function restore($id)
    {
        $program = WorkProgram::onlyTrashed()->findOrFail($id);
        $program->restore();
        
        return redirect()->route('staff.program.trash')->with('success', 'Program kerja berhasil dikembalikan!');
    }
    
    /**
     * Menghapus permanen data
     */
    public function forceDelete($id)
    {
        $program = WorkProgram::onlyTrashed()->findOrFail($id);
        $program->forceDelete();
        
        return redirect()->route('staff.program.trash')->with('success', 'Program kerja berhasil dihapus permanen!');
    }
    
    /**
     * Export data program kerja ke Excel
     */
    public function export()
    {
        // nama file yang akan di unduh
        $fileName = 'data-program-kerja.xlsx';
        
        // proses unduh
        return Excel::download(new WorkProgramExport, $fileName);
    }
}