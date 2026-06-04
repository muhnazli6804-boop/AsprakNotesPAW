@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h1 class="h4 fw-bold text-dark mb-0 d-flex align-items-center gap-2">
        <i class="bi bi-calendar-check text-danger"></i>
        @can('admin') Semua Absensi @else Riwayat Absensi @endcan
    </h1>
    @cannot('admin')
        <a href="{{ route('absensi.create') }}" class="btn btn-danger d-flex align-items-center gap-1 shadow-sm"><i class="bi bi-plus-circle"></i>Tambah Absensi</a>
    @endcannot
</div>
<div class="card border-0 shadow-sm" style="border-radius:16px;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        @can('admin')
                            <th>Nama Asprak</th>
                        @endcan
                        <th>Modul</th>
                        <th>Kelas</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Bukti</th>
                        @can('admin')
                            <th>Aksi</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach($absensis as $absensi)
                    <tr>
                        @can('admin')
                            <td>{{ $absensi->user->name }}</td>
                        @endcan
                        <td>{{ $absensi->modul->nama }}</td>
                        <td>{{ $absensi->kelas }}</td>
                        <td>{{ $absensi->tanggal }}</td>
                        <td>
                            @php
                                $transfer = $absensi->transfer ?? ($absensi->transfer = \App\Models\Transfer::where('absensi_id', $absensi->id)->latest()->first());
                            @endphp
                            @if($transfer && $transfer->status == 'selesai')
                                <span class="badge bg-success text-white px-3 py-2" style="font-size:13px; border-radius:8px;">
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
                        </td>
                        <td>
                            @if($absensi->bukti_absensi)
                                <a href="{{ asset('storage/'.$absensi->bukti_absensi) }}" target="_blank" class="text-danger d-flex align-items-center gap-1"><i class="bi bi-image"></i>Lihat</a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        @can('admin')
                            <td>
                                <a href="{{ route('absensi.show', $absensi) }}" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1"><i class="bi bi-eye"></i>Detail</a>
                            </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
