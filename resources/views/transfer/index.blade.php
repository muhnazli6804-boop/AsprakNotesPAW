@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h4 fw-bold text-danger mb-4"><i class="bi bi-cash-coin"></i> Riwayat Slip Gaji</h1>
    @can('admin')
        <a href="{{ route('transfer.create') }}" class="btn btn-danger mb-3"><i class="bi bi-plus-circle"></i> Transfer Gaji</a>
    @endcan
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            @can('admin')
                                <th>Nama Asprak</th>
                            @endcan
                            <th>Nominal</th>
                            <th>Keterangan</th>
                            <th>Absensi</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transfers as $transfer)
                        <tr>
                            @can('admin')
                                <td>{{ $transfer->user->name }}</td>
                            @endcan
                            <td>Rp{{ number_format($transfer->nominal,0,',','.') }}</td>
                            <td>{{ $transfer->keterangan ?? '-' }}</td>
                            <td>
                                @if($transfer->absensi)
                                    {{ $transfer->absensi->modul->nama }} ({{ $transfer->absensi->kelas }}, {{ $transfer->absensi->tanggal }})
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $transfer->tanggal }}</td>
                            <td>
                                <span class="badge bg-success-subtle text-success px-3 py-2" style="font-size:13px; border-radius:8px;">
                                    Selesai
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada riwayat transfer.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
