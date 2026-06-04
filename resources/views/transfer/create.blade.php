@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0 mx-auto" style="max-width: 500px;">
    <div class="card-body">
        <h1 class="h4 fw-bold text-danger mb-4"><i class="bi bi-plus-circle"></i> Transfer Gaji ke Asprak</h1>
        <form method="POST" action="{{ route('transfer.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label text-danger">Pilih Asprak</label>
                <select name="user_id" id="asprakSelect" class="form-select border-danger" required>
                    <option value="">Pilih Asprak</option>
                    @foreach($aspraks as $asprak)
                        <option value="{{ $asprak->id }}">{{ $asprak->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label text-danger">Pilih Absensi</label>
                <select name="absensi_id" id="absensiSelect" class="form-select border-danger" required>
                    <option value="">-- Pilih Absensi --</option>
                    @foreach($aspraks as $asprak)
                        @if(isset($absensis[$asprak->id]))
                            @foreach($absensis[$asprak->id] as $absensi)
                                <option value="{{ $absensi->id }}" data-user="{{ $asprak->id }}" data-gaji="{{ $absensi->modul->gaji }}">
                                    {{ $absensi->modul->nama }} ({{ $absensi->kelas }}, {{ $absensi->tanggal }})
                                </option>
                            @endforeach
                        @endif
                    @endforeach
                </select>
                <small class="text-muted">pilih absensi yang ingin ditransfer gajinya.</small>
            </div>
            <div class="mb-3">
                <label class="form-label text-danger">Nominal</label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input name="nominal" id="nominalInput" type="number" class="form-control border-danger" required min="1">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label text-danger">Keterangan</label>
                <input name="keterangan" class="form-control border-danger" required>
            </div>
            <div class="mb-3">
                <label class="form-label text-danger">Tanggal Transfer</label>
                <input type="date" name="tanggal" class="form-control border-danger" required>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('transfer.index') }}" class="btn btn-outline-secondary"><i class="bi bi-x"></i> Batal</a>
                <button type="submit" class="btn btn-danger"><i class="bi bi-save"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const asprakSelect = document.getElementById('asprakSelect');
    const absensiSelect = document.getElementById('absensiSelect');
    const nominalInput = document.getElementById('nominalInput');
    function filterAbsensi() {
        const userId = asprakSelect.value;
        let hasOption = false;
        Array.from(absensiSelect.options).forEach(opt => {
            if (!opt.value) {
                opt.style.display = '';
                return;
            }
            if (userId && opt.getAttribute('data-user') === userId) {
                opt.style.display = '';
                hasOption = true;
            } else {
                opt.style.display = 'none';
            }
        });
        absensiSelect.value = '';
        nominalInput.value = '';
        nominalInput.readOnly = false;
    }
    function setNominalFromAbsensi() {
        const selected = absensiSelect.options[absensiSelect.selectedIndex];
        if (selected && selected.value && selected.getAttribute('data-gaji')) {
            nominalInput.value = selected.getAttribute('data-gaji');
            nominalInput.readOnly = true;
        } else {
            nominalInput.value = '';
            nominalInput.readOnly = false;
        }
    }
    asprakSelect.addEventListener('change', filterAbsensi);
    absensiSelect.addEventListener('change', setNominalFromAbsensi);
    // Pada load awal, sembunyikan semua kecuali option kosong
    Array.from(absensiSelect.options).forEach(opt => {
        if (opt.value) opt.style.display = 'none';
    });
});
</script>
@endsection
