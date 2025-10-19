<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Exports\AnggotaExport;
use Maatwebsite\Excel\Facades\Excel;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anggotas = User::all();
        return view('admin.anggota.index', compact('anggotas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,staff,member',
            'gender' => 'nullable|in:laki-laki,perempuan',
            'birth_date' => 'nullable|date|before:today',
            'join_date' => 'nullable|date',
            'address' => 'nullable|string',
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'role.required' => 'Role wajib dipilih',
            'role.in' => 'Role tidak valid',
            'gender.in' => 'Jenis kelamin tidak valid',
            'birth_date.before' => 'Tanggal lahir harus sebelum hari ini',
        ]);

        $data = $request->except('password', 'password_confirmation');
        $data['password'] = Hash::make($request->password);

        $anggota = User::create($data);

        if ($anggota) {
            return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan anggota, silakan coba lagi');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anggota = User::findOrFail($id);
        return view('admin.anggota.show', compact('anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $anggota = User::findOrFail($id);
        return view('admin.anggota.edit', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $anggota = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,staff,member',
            'gender' => 'nullable|in:laki-laki,perempuan',
            'birth_date' => 'nullable|date|before:today',
            'join_date' => 'nullable|date',
            'address' => 'nullable|string',
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'role.required' => 'Role wajib dipilih',
            'role.in' => 'Role tidak valid',
            'gender.in' => 'Jenis kelamin tidak valid',
            'birth_date.before' => 'Tanggal lahir harus sebelum hari ini',
        ]);

        $data = $request->except('password', 'password_confirmation');

        // Update password jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $update = $anggota->update($data);

        if ($update) {
            return redirect()->route('admin.anggota.index')->with('success', 'Data anggota berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui data anggota, silakan coba lagi');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $anggota = User::findOrFail($id);

        // Hapus foto jika ada
        if ($anggota->foto) {
            Storage::disk('public')->delete($anggota->foto);
        }

        $delete = $anggota->delete();

        if ($delete) {
            return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus anggota, silakan coba lagi');
        }
    }
    
    /**
     * Menampilkan data yang dihapus
     */
    public function trash()
    {
        $anggotas = User::onlyTrashed()->get();
        return view('admin.anggota.trash', compact('anggotas'));
    }
    
    /**
     * Mengembalikan data yang dihapus
     */
    public function restore($id)
    {
        $anggota = User::onlyTrashed()->findOrFail($id);
        $anggota->restore();
        
        return redirect()->route('admin.anggota.trash')->with('success', 'Anggota berhasil dikembalikan!');
    }
    
    /**
     * Menghapus permanen data
     */
    public function forceDelete($id)
    {
        $anggota = User::onlyTrashed()->findOrFail($id);
        
        // Hapus foto jika ada
        if ($anggota->foto) {
            Storage::disk('public')->delete($anggota->foto);
        }
        
        $anggota->forceDelete();
        
        return redirect()->route('admin.anggota.trash')->with('success', 'Anggota berhasil dihapus permanen!');
    }
    
    /**
     * Export data anggota to Excel
     */
    public function export()
    {
        return Excel::download(new AnggotaExport, 'data-anggota-' . date('Y-m-d') . '.xlsx');
    }
}