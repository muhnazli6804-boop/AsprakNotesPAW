@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0 mx-auto" style="max-width: 600px; border-radius:18px; background:linear-gradient(135deg,#fff 80%,#ffeaea 100%);">
    <div class="card-body p-4">
        <h1 class="h5 fw-bold text-dark mb-3 d-flex align-items-center gap-2">
            <i class="bi bi-calendar-check text-danger"></i>Detail Absensi
        </h1>
        <div class="mb-4">
            <div class="mb-2"><b>Nama Asprak:</b> {{ $absensi->user->name }}</div>
            <div class="mb-2"><b>Modul:</b> {{ $absensi->modul->nama }}</div>
            <div class="mb-2"><b>Kelas:</b> {{ $absensi->kelas }}</div>
            <div class="mb-2"><b>Tanggal:</b> {{ $absensi->tanggal }}</div>
            <div class="mb-2"><b>Status:</b>
                @php
                    $transfer = $absensi->transfer ?? (\App\Models\Transfer::where('absensi_id', $absensi->id)->latest()->first());
                @endphp
                @if($transfer && $transfer->status == 'selesai')
                    <span class="badge bg-success-subtle text-success px-3 py-2" style="font-size:13px; border-radius:8px;">
                        Selesai
                    </span>
                @elseif($transfer)
                    <span class="badge
                        @if($transfer->status=='berhasil') bg-success-subtle text-success
                        @elseif($transfer->status=='gagal') bg-danger-subtle text-danger
                        @else bg-warning-subtle text-warning @endif
                        px-3 py-2" style="font-size:13px; border-radius:8px;">
                        {{ ucfirst($transfer->status) }}
                    </span>
                @else
                    <span class="badge bg-warning-subtle text-warning px-3 py-2" style="font-size:13px; border-radius:8px;">
                        Diproses
                    </span>
                @endif
            </div>
            <div class="mb-2"><b>Bukti Absensi:</b>
                @if($absensi->bukti_absensi)
                    <a href="{{ asset('storage/'.$absensi->bukti_absensi) }}" target="_blank" class="text-danger d-flex align-items-center gap-1">
                        <i class="bi bi-image"></i>Lihat Bukti
                    </a>
                @else
                    <span class="text-muted">Tidak ada</span>
                @endif
            </div>
        </div>
        {{-- Hapus form ubah status --}}
    </div>
</div>
@endsection
