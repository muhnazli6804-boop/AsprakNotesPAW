<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ModulController extends Controller
{
    use AuthorizesRequests;

    // List modul untuk user & admin
    public function index()
    {
        $moduls = Modul::orderBy('created_at', 'desc')->get();
        return view('modul.index', compact('moduls'));
    }

    // Detail modul
    public function show(Modul $modul)
    {
        return view('modul.show', compact('modul'));
    }

    // Admin: form tambah modul
    public function create()
    {
        $this->authorize('admin');
        return view('modul.create');
    }

    // Admin: simpan modul baru
    public function store(Request $request)
    {
        $this->authorize('admin');
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            // file modul bisa pdf, png, jpeg, jpg
            'gambar' => 'nullable|mimes:pdf,png,jpeg,jpg|max:10240', // max 10MB
            'gaji' => 'required|numeric|min:0',
        ]);
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('modul', 'public');
        }
        Modul::create($validated);
        return redirect()->route('modul.index')->with('success', 'Modul berhasil ditambahkan');
    }

    // Admin: form edit modul
    public function edit(Modul $modul)
    {
        $this->authorize('admin');
        return view('modul.edit', compact('modul'));
    }

    // Admin: update modul
    public function update(Request $request, Modul $modul)
    {
        $this->authorize('admin');
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            // file modul bisa pdf, png, jpeg, jpg
            'gambar' => 'nullable|mimes:pdf,png,jpeg,jpg|max:10240', // max 10MB
            'gaji' => 'required|numeric|min:0',
        ]);
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('modul', 'public');
        }
        $modul->update($validated);
        return redirect()->route('modul.index')->with('success', 'Modul berhasil diupdate');
    }

    // Admin: hapus modul
    public function destroy(Modul $modul)
    {
        $this->authorize('admin');
        $modul->delete();
        return redirect()->route('modul.index')->with('success', 'Modul berhasil dihapus');
    }
}
