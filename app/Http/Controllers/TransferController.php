<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TransferController extends Controller
{
    use AuthorizesRequests;

    // Riwayat transfer (admin: semua, asprak: miliknya)
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $transfers = Transfer::with('user')->latest()->get();
        } else {
            $transfers = Transfer::where('user_id', Auth::id())->latest()->get();
        }
        return view('transfer.index', compact('transfers'));
    }

    // Form transfer (admin)
    public function create()
    {
        $this->authorize('admin');
        $aspraks = User::where('role', 'asprak')->get();
        // Ambil semua absensi yang belum pernah ditransfer, tanpa filter status
        $absensis = \App\Models\Absensi::whereDoesntHave('transfer', function($q) {
                $q->where('status', 'selesai');
            })
            ->with('user', 'modul')
            ->orderBy('tanggal', 'desc')
            ->get()
            ->groupBy('user_id');
        return view('transfer.create', compact('aspraks', 'absensis'));
    }

    // Simpan transfer (admin)
    public function store(Request $request)
    {
        $this->authorize('admin');
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'absensi_id' => 'nullable|exists:absensis,id',
            'nominal' => 'nullable|numeric|min:1',
            'keterangan' => 'nullable|string|max:255',
            'tanggal' => 'required|date',
            // status dihapus dari validasi
        ]);

        // Jika absensi dipilih, ambil nominal dari modul terkait
        if (!empty($validated['absensi_id'])) {
            $absensi = \App\Models\Absensi::with('modul')->find($validated['absensi_id']);
            if ($absensi && $absensi->modul) {
                $validated['nominal'] = $absensi->modul->gaji;
            }
        }

        // Jika nominal masih kosong (tidak pilih absensi), wajib diisi manual
        if (empty($validated['nominal'])) {
            return back()->withInput()->withErrors(['nominal' => 'Nominal wajib diisi jika tidak memilih absensi.']);
        }

        $validated['status'] = 'selesai';

        \App\Models\Transfer::create($validated);
        return redirect()->route('transfer.index')->with('success', 'Transfer berhasil dicatat');
    }
}
