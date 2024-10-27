<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    // Menampilkan daftar foto
    public function index()
    {
        $fotos = Foto::where('user_id', Auth::id())->get(); // Ambil foto berdasarkan ID pengguna yang sedang login
        return view('mahasiswa.foto.index', compact('fotos'));
    }

    // Menampilkan form untuk membuat foto
    public function create()
    {
        return view('mahasiswa.foto.create');
    }

    // Menyimpan foto baru
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048', // Validasi file foto
        ]);

        $filePath = $request->file('file')->store('fotos', 'public'); // Simpan foto

        Foto::create([
            'user_id' => Auth::id(), // ID pengguna yang sedang login
            'file_path' => $filePath,
        ]);

        return redirect()->route('foto.index')->with('success', 'Foto berhasil diupload.');
    }

    // Menampilkan form untuk edit foto
    public function edit($id)
    {
        $foto = Foto::findOrFail($id);
        return view('mahasiswa.foto.edit', compact('foto'));
    }

    // Mengupdate foto yang sudah ada
    public function update(Request $request, $id)
    {
        $request->validate([
            'file' => 'nullable|image|max:2048', // Validasi file foto
        ]);

        $foto = Foto::findOrFail($id);

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            Storage::disk('public')->delete($foto->file_path);
            $filePath = $request->file('file')->store('fotos', 'public');
            $foto->file_path = $filePath; // Update path foto
        }

        $foto->save(); // Simpan perubahan

        return redirect()->route('foto.index')->with('success', 'Foto berhasil diperbarui.');
    }

    // Menghapus foto
    public function destroy($id)
    {
        $foto = Foto::findOrFail($id);
        Storage::disk('public')->delete($foto->file_path); // Hapus file dari storage
        $foto->delete(); // Hapus data foto dari database

        return redirect()->route('foto.index')->with('success', 'Foto berhasil dihapus.');
    }
}
