<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\WorkProgram;
use Illuminate\Http\Request;

class ProgramController extends Controller
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
}
