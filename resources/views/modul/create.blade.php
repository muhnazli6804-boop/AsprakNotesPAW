@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0 mx-auto" style="max-width: 500px;">
    <div class="card-body">
        <h1 class="h4 fw-bold text-danger mb-4"><i class="bi bi-plus-circle me-2"></i>Tambah Modul</h1>
        <form method="POST" action="{{ route('modul.store') }}" enctype="multipart/form-data" id="form-modul">
            @csrf
            <div class="mb-3">
                <label class="form-label text-danger">Nama</label>
                <input name="nama" class="form-control border-danger" required>
            </div>
            <div class="mb-3">
                <label class="form-label text-danger">Deskripsi</label>
                <textarea name="deskripsi" class="form-control border-danger" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label text-danger">Lampiran (PDF/Gambar)</label>
                <input type="file" name="gambar" class="form-control border-danger" required id="gambar-input" accept=".pdf,image/*">
                <div class="text-danger small mt-1 d-none" id="file-alert">File terlalu besar (maksimal 10MB).</div>
            </div>
            <div class="mb-3">
                <label class="form-label text-danger">Gaji</label>
                <input name="gaji" type="number" class="form-control border-danger" required>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('modul.index') }}" class="btn btn-outline-secondary"><i class="bi bi-x"></i> Batal</a>
                <button type="submit" class="btn btn-danger"><i class="bi bi-save"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>
<script>
document.getElementById('form-modul').addEventListener('submit', function(e) {
    var fileInput = document.getElementById('gambar-input');
    var alertDiv = document.getElementById('file-alert');
    if (fileInput.files.length > 0) {
        var file = fileInput.files[0];
        if (file.size > 10 * 1024 * 1024) { // 10MB
            alertDiv.classList.remove('d-none');
            fileInput.value = '';
            e.preventDefault();
            return false;
        } else {
            alertDiv.classList.add('d-none');
        }
    }
});
</script>
@endsection
