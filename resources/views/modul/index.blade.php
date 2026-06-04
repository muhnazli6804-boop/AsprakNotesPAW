@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h1 class="h4 fw-bold text-dark mb-0 d-flex align-items-center gap-2">
        <i class="bi bi-journal-bookmark text-danger"></i>Daftar Modul
    </h1>
    @can('admin')
        <a href="{{ route('modul.create') }}" class="btn btn-danger d-flex align-items-center gap-1 shadow-sm"><i class="bi bi-plus-circle"></i>Tambah Modul</a>
    @endcan
</div>
<div class="row g-4">
    @forelse($moduls as $modul)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius:18px; background:linear-gradient(135deg,#fff 80%,#ffeaea 100%); transition:box-shadow .18s;">
                <div class="card-body d-flex flex-column p-4">
                    <h5 class="card-title text-dark fw-semibold mb-2 d-flex align-items-center gap-2">
                        <i class="bi bi-bookmark text-danger"></i>{{ $modul->nama }}
                    </h5>
                    <p class="card-text text-secondary mb-3" style="min-height:60px;">{{ $modul->deskripsi }}</p>
                    <span class="badge bg-danger bg-opacity-10 text-danger mb-3 px-3 py-2" style="font-size:13px; border-radius:8px;">
                        <i class="bi bi-cash-coin"></i> Gaji: Rp{{ number_format($modul->gaji,0,',','.') }}
                    </span>
                    <div class="mt-auto d-flex flex-wrap gap-2">
                        <a href="{{ route('modul.show', $modul) }}" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1 shadow-none"><i class="bi bi-eye"></i>Detail</a>
                        @can('admin')
                            <a href="{{ route('modul.edit', $modul) }}" class="btn btn-warning btn-sm text-white d-flex align-items-center gap-1 shadow-none"><i class="bi bi-pencil"></i>Edit</a>
                            <form action="{{ route('modul.destroy', $modul) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus modul?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center gap-1 shadow-none"><i class="bi bi-trash"></i>Hapus</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center text-muted py-5">
            <div class="mb-2 display-1 text-danger-50">&#9888;</div>
            <div class="h5">Belum ada modul.</div>
        </div>
    @endforelse
</div>
@endsection
