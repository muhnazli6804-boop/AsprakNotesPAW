<div class="container py-4">
    <h2 class="fw-bold mb-4 text-danger"><i class="bi bi-speedometer2"></i> Dashboard Admin</h2>
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <div class="display-5 fw-bold text-danger">{{ $totalModul }}</div>
                    <div class="text-muted">Total Modul</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <div class="display-5 fw-bold text-danger">{{ $totalAbsensi }}</div>
                    <div class="text-muted">Total Absensi</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <div class="display-5 fw-bold text-danger">{{ $totalUser }}</div>
                    <div class="text-muted">Total User</div>
                </div>
            </div>
        </div>
    </div>
    <h4 class="fw-bold mb-3">Absensi Terbaru</h4>
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table mb-0 align-middle">
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
                            <span class="badge
                                @if($absensi->status=='disetujui') bg-success-subtle text-success
                                @elseif($absensi->status=='ditolak') bg-danger-subtle text-danger
                                @elseif($absensi->status=='diproses') bg-warning-subtle text-warning
                                @else bg-secondary-subtle text-secondary @endif
                                px-3 py-2" style="font-size:13px; border-radius:8px;">
                                <i class="bi bi-circle-fill" style="font-size:9px;"></i>
                                {{ ucfirst($absensi->status) }}
                            </span>
                        </td>
                        <td>{{ $absensi->tanggal }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
