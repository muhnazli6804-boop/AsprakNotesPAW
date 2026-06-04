@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0 mx-auto" style="max-width: 500px;">
    <div class="card-body">
        <h1 class="h4 fw-bold text-danger mb-4"><i class="bi bi-pencil me-2"></i>Edit Modul</h1>
        <form method="POST" action="{{ route('modul.update', $modul) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label text-danger">Nama</label>
                <input name="nama" value="{{ $modul->nama }}" class="form-control border-danger" required>
            </div>
            <div class="mb-3">
                <label class="form-label text-danger">Deskripsi</label>
                <textarea name="deskripsi" class="form-control border-danger" required>{{ $modul->deskripsi }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label text-danger">Lampiran (PDF/Gambar)</label>
                <input type="file" name="gambar" class="form-control border-danger" required>
            </div>
            <div class="mb-3">
                <label class="form-label text-danger">Gaji</label>
                <input name="gaji" type="number" value="{{ $modul->gaji }}" class="form-control border-danger" required>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('modul.index') }}" class="btn btn-outline-secondary"><i class="bi bi-x"></i> Batal</a>
                <button type="submit" class="btn btn-danger"><i class="bi bi-save"></i> Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
