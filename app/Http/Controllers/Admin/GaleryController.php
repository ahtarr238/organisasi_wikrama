<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galery;
use App\Exports\GaleryExportNew as GaleryExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class GaleryController extends Controller
{
    public function index()
    {
        $galleries = Galery::orderBy('uploaded_at', 'desc')->get();
        return view('admin.galery.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:osis,mpk',
            'description' => 'required|string',
            'photo_url' => 'required|mimes:jpeg,png,jpg,webp,svg|max:2048',
        ]);

        // Upload gambar
        if ($request->hasFile('photo_url')) {
            $image = $request->file('photo_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('galery', $imageName, 'public');

            if (!$path) {
                return redirect()->back()->withInput()->with('error', 'Gagal mengupload gambar!');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Gambar wajib diupload!');
        }

        $gallery = new Galery();
        $gallery->title = $request->title;
        $gallery->category = strtolower($request->category);
        $gallery->description = $request->description;
        $gallery->photo_url = $imageName;
        $gallery->uploaded_by = Auth::user()->id;
        $gallery->uploaded_at = now();

        $saved = $gallery->save();

        if ($saved) {
            return redirect()->route('admin.galery.index')->with('success', 'Galeri berhasil ditambahkan!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan galeri!');
        }
    }

    public function show($id)
    {
        $gallery = Galery::findOrFail($id);
        return view('admin.galery.show', compact('gallery'));
    }

    public function edit($id)
    {
        $gallery = Galery::findOrFail($id);
        return view('admin.galery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:osis,mpk',
            'description' => 'required|string',
            'photo_url' => 'nullable|mimes:jpeg,png,jpg,webp,svg|max:2048',
        ]);

        $gallery = Galery::findOrFail($id);
        $gallery->title = $request->title;
        $gallery->category = strtolower($request->category);
        $gallery->description = $request->description;

        // Upload gambar baru jika ada
        if ($request->hasFile('photo_url')) {
            // Hapus gambar lama
            if ($gallery->photo_url) {
                Storage::disk('public')->delete('galery/' . $gallery->photo_url);
            }

            $image = $request->file('photo_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('galery', $imageName, 'public');

            if ($path) {
                $gallery->photo_url = $imageName;
            }
        }

        $gallery->save();

        return redirect()->route('admin.galery.index')->with('success', 'Galeri berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $gallery = Galery::findOrFail($id);

        // Hapus gambar dari storage
        if ($gallery->photo_url) {
            Storage::disk('public')->delete('galery/' . $gallery->photo_url);
        }

        $gallery->delete();

        return redirect()->route('admin.galery.index')->with('success', 'Galeri berhasil dihapus!');
    }
    
    /**
     * Menampilkan data yang dihapus
     */
    public function trash()
    {
        $galleries = Galery::onlyTrashed()->get();
        return view('admin.galery.trash', compact('galleries'));
    }
    
    /**
     * Mengembalikan data yang dihapus
     */
    public function restore($id)
    {
        $gallery = Galery::onlyTrashed()->findOrFail($id);
        $gallery->restore();
        
        return redirect()->route('admin.galery.trash')->with('success', 'Galeri berhasil dikembalikan!');
    }
    
    /**
     * Menghapus permanen data
     */
    public function forceDelete($id)
    {
        $gallery = Galery::onlyTrashed()->findOrFail($id);
        
        // Hapus gambar dari storage
        if ($gallery->photo_url) {
            Storage::disk('public')->delete('galery/' . $gallery->photo_url);
        }
        
        $gallery->forceDelete();
        
        return redirect()->route('admin.galery.trash')->with('success', 'Galeri berhasil dihapus permanen!');
    }
    
    /**
     * Export data galeri ke Excel
     */
    public function export()
    {
        // nama file yang akan di unduh
        $fileName = 'data-galeri.xlsx';
        
        // proses unduh
        return Excel::download(new GaleryExport, $fileName);
    }
}