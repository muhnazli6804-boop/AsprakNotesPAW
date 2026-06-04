<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AbsensiController extends Controller
{
    use AuthorizesRequests;

    // List absensi untuk user (riwayat) dan admin (semua)
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $absensis = Absensi::with('user', 'modul')->latest()->get();
        } else {
            $absensis = Auth::user()->absensis()->with('modul')->latest()->get();
        }
        return view('absensi.index', compact('absensis'));
    }

    // Form tambah absensi (user)
    public function create()
    {
        $moduls = \App\Models\Modul::all();
        return view('absensi.create', compact('moduls'));
    }

    // Simpan absensi (user)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'modul_id' => 'required|exists:modul,id',
            'kelas' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'bukti_absensi' => 'nullable|image|max:2048',
        ]);
        $validated['user_id'] = Auth::id();
        if ($request->hasFile('bukti_absensi')) {
            $validated['bukti_absensi'] = $request->file('bukti_absensi')->store('bukti_absensi', 'public');
        }
        Absensi::create($validated);
        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil ditambahkan');
    }

    // Detail absensi (admin)
    public function show(Absensi $absensi)
    {
        $this->authorize('admin');
        $absensi->load('user', 'modul');
        return view('absensi.show', compact('absensi'));
    }

    // Update status absensi (admin)
    public function update(Request $request, Absensi $absensi)
    {
        $this->authorize('admin');
        $request->validate([
            'status' => 'required|in:menunggu,diproses,disetujui,ditolak',
        ]);
        $absensi->status = $request->status;
        $absensi->save();
        return redirect()->route('absensi.index')->with('success', 'Status absensi diperbarui');
    }
}
