@if(session('loginSuccess'))
<!-- Modal Dashboard User -->
<div class="modal fade" id="dashboardUserModal" tabindex="-1" aria-labelledby="dashboardUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header border-0 pb-0">
        <h2 class="fw-bold mb-0 text-danger d-flex align-items-center gap-2" id="dashboardUserModalLabel">
          <i class="bi bi-speedometer2"></i> Dashboard
        </h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pt-0">
        <div class="alert alert-success mb-4">You're logged in!</div>
        <h4 class="fw-bold mb-3">Riwayat Absensi Terakhir</h4>
        <div class="card shadow-sm border-0 mb-0">
          <div class="card-body p-0">
            <table class="table mb-0 align-middle">
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
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var dashboardModal = new bootstrap.Modal(document.getElementById('dashboardUserModal'), {
      backdrop: 'static',
      keyboard: true
    });
    dashboardModal.show();
  });
</script>
@endif
