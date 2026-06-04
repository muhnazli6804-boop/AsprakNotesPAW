@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0 mx-auto" style="max-width: 600px; border-radius:18px; background:linear-gradient(135deg,#fff 80%,#ffeaea 100%);">
    <div class="card-body p-4">
        <h1 class="h5 fw-bold text-dark mb-2 d-flex align-items-center gap-2">
            <i class="bi bi-journal-bookmark text-danger"></i>{{ $modul->nama }}
        </h1>
        <p class="text-secondary mb-2">{{ $modul->deskripsi }}</p>
        <span class="badge bg-danger bg-opacity-10 text-danger mb-3 px-3 py-2" style="font-size:13px; border-radius:8px;">
            <i class="bi bi-cash-coin"></i> Gaji: Rp{{ number_format($modul->gaji,0,',','.') }}
        </span>
        @if($modul->gambar)
            <div class="mb-3">
                <label class="fw-semibold text-danger mb-1 d-block">Lampiran:</label>
                @php
                    $ext = strtolower(pathinfo($modul->gambar, PATHINFO_EXTENSION));
                @endphp
                @if(in_array($ext, ['jpg','jpeg','png']))
                    <img src="{{ asset('storage/'.$modul->gambar) }}" alt="Lampiran" class="rounded border mb-2 img-fluid">
                    <div>
                        <a href="{{ asset('storage/'.$modul->gambar) }}" target="_blank" class="link-danger d-flex align-items-center gap-1"><i class="bi bi-image"></i>Lihat Gambar Penuh</a>
                    </div>
                @elseif($ext === 'pdf')
                    <a href="{{ asset('storage/'.$modul->gambar) }}" target="_blank" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1">
                        <i class="bi bi-file-earmark-pdf"></i> Lihat Lampiran
                    </a>
                @else
                    <a href="{{ asset('storage/'.$modul->gambar) }}" target="_blank" class="link-danger d-flex align-items-center gap-1"><i class="bi bi-paperclip"></i> Download Lampiran</a>
                @endif
            </div>
        @endif
        <a href="{{ route('modul.index') }}" class="btn btn-link text-danger d-flex align-items-center gap-1 mt-2" style="font-weight:500;"><i class="bi bi-arrow-left"></i> Kembali ke Daftar Modul</a>
    </div>
</div>
@endsection
