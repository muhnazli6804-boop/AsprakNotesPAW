@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0 mx-auto" style="max-width: 500px; border-radius:18px; background:linear-gradient(135deg,#fff 80%,#ffeaea 100%);">
    <div class="card-body p-4">
        <h1 class="h5 fw-bold text-dark mb-4 d-flex align-items-center gap-2"><i class="bi bi-calendar-plus text-danger"></i>Tambah Absensi</h1>
        <form method="POST" action="{{ route('absensi.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label text-danger">Modul</label>
                <select name="modul_id" class="form-select border-danger" required>
                    <option value="">Pilih Modul</option>
                    @foreach($moduls as $modul)
                        <option value="{{ $modul->id }}">{{ $modul->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label text-danger">Kelas</label>
                <input name="kelas" class="form-control border-danger" required>
            </div>
            <div class="mb-3">
                <label class="form-label text-danger">Tanggal</label>
                <input type="date" name="tanggal" class="form-control border-danger" required>
            </div>
            <div class="mb-3">
                <label class="form-label text-danger">Bukti Absensi </label>
                <input type="file" name="bukti_absensi" accept="image/*" class="form-control border-danger" required>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('absensi.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-1"><i class="bi bi-x"></i> Batal</a>
                <button type="submit" class="btn btn-danger d-flex align-items-center gap-1"><i class="bi bi-save"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
