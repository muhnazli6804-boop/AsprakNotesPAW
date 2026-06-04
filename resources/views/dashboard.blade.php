@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius:18px; background:linear-gradient(135deg,#fff 80%,#ffeaea 100%);">
                <div class="card-body p-4">
                    <h1 class="display-6 fw-bold text-danger mb-2">{{ __('Welcome back') }}, {{ Auth::user()->name }}!</h1>
                    <p class="text-muted mb-0">{{ Auth::user()->role === 'admin' ? 'Administrator Dashboard' : 'Asisten Praktikum Dashboard' }}</p>
                </div>
            </div>
        </div>
    </div>

    @if(Auth::user()->role === 'admin')
    <!-- Admin Stats -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <a href="{{ route('modul.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100" style="border-radius:15px;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="display-6 fw-bold text-danger me-3">{{ $totalModul }}</span>
                            <i class="bi bi-journal-bookmark fs-1 text-danger opacity-25"></i>
                        </div>
                        <h5 class="fw-semibold text-dark mb-0">Total Modul</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('absensi.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100" style="border-radius:15px;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="display-6 fw-bold text-danger me-3">{{ $totalAbsensi }}</span>
                            <i class="bi bi-calendar-check fs-1 text-danger opacity-25"></i>
                        </div>
                        <h5 class="fw-semibold text-dark mb-0">Total Absensi</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('users.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100" style="border-radius:15px;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="display-6 fw-bold text-danger me-3">{{ $totalUser }}</span>
                            <i class="bi bi-people fs-1 text-danger opacity-25"></i>
                        </div>
                        <h5 class="fw-semibold text-dark mb-0">Total User</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Admin Recent Activities -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius:18px;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold mb-0">Absensi Terbaru</h4>
                        <a href="{{ route('absensi.index') }}" class="btn btn-outline-danger btn-sm">
                            Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Asprak</th>
                                    <th>Modul</th>
                                    <th>Kelas</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($absensiTerbaru as $absensi)
                                <tr>
                                    <td>{{ $absensi->user->name }}</td>
                                    <td>{{ $absensi->modul->nama }}</td>
                                    <td>{{ $absensi->kelas }}</td>
                                    <td>
                                        @php
                                            $transfer = $absensi->transfer ?? (\App\Models\Transfer::where('absensi_id', $absensi->id)->latest()->first());
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
                                            <span class="badge 
                                                @if($absensi->status=='disetujui') bg-success-subtle text-success
                                                @elseif($absensi->status=='ditolak') bg-danger-subtle text-danger
                                                @elseif($absensi->status=='diproses') bg-warning-subtle text-warning
                                                @else bg-secondary-subtle text-secondary @endif
                                                px-3 py-2" style="font-size:13px; border-radius:8px;">
                                                <i class="bi bi-circle-fill" style="font-size:9px;"></i>
                                                {{ ucfirst($absensi->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $absensi->tanggal }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @else
    <!-- User Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex gap-2">
                <a href="{{ route('absensi.create') }}" class="btn btn-danger">
                    <i class="bi bi-plus-circle me-1"></i>Tambah Absensi
                </a>
                <a href="{{ route('modul.index') }}" class="btn btn-outline-danger">
                    <i class="bi bi-journal-bookmark me-1"></i>Lihat Modul
                </a>
            </div>
        </div>
    </div>

    <!-- User Recent Activities -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius:18px;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold mb-0">Riwayat Absensi</h4>
                        <a href="{{ route('absensi.index') }}" class="btn btn-outline-danger btn-sm">
                            Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Modul</th>
                                    <th>Kelas</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($riwayatAbsensi as $absensi)
                                <tr>
                                    <td>{{ $absensi->modul->nama }}</td>
                                    <td>{{ $absensi->kelas }}</td>
                                    <td>
                                        @php
                                            $transfer = $absensi->transfer ?? (\App\Models\Transfer::where('absensi_id', $absensi->id)->latest()->first());
                                        @endphp
                                        @if($transfer)
                                            @if($transfer->status == 'selesai')
                                                <span class="badge bg-success text-white px-3 py-2" style="font-size:13px; border-radius:8px;">
                                                    Selesai
                                                </span>
                                            @elseif($transfer->status == 'berhasil')
                                                <span class="badge bg-success-subtle text-success px-3 py-2" style="font-size:13px; border-radius:8px;">
                                                    Berhasil
                                                </span>
                                            @elseif($transfer->status == 'gagal')
                                                <span class="badge bg-danger-subtle text-danger px-3 py-2" style="font-size:13px; border-radius:8px;">
                                                    Gagal
                                                </span>
                                            @else
                                                <span class="badge bg-warning-subtle text-warning px-3 py-2" style="font-size:13px; border-radius:8px;">
                                                    {{ ucfirst($transfer->status) }}
                                                </span>
                                            @endif
                                        @else
                                            <span class="badge 
                                                @if($absensi->status=='disetujui') bg-success-subtle text-success
                                                @elseif($absensi->status=='ditolak') bg-danger-subtle text-danger
                                                @elseif($absensi->status=='diproses') bg-warning-subtle text-warning
                                                @else bg-secondary-subtle text-secondary @endif
                                                px-3 py-2" style="font-size:13px; border-radius:8px;">
                                                <i class="bi bi-circle-fill" style="font-size:9px;"></i>
                                                {{ ucfirst($absensi->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $absensi->tanggal }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
