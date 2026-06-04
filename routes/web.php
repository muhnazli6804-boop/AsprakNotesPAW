<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Semua route di bawah ini hanya untuk user yang sudah login & verified
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $totalModul = \App\Models\Modul::count();
            $totalAbsensi = \App\Models\Absensi::count();
            $totalUser = \App\Models\User::count();
            $absensiTerbaru = \App\Models\Absensi::with('user','modul')
                ->latest()
                ->take(5)
                ->get();
            
            return view('dashboard', compact('totalModul', 'totalAbsensi', 'totalUser', 'absensiTerbaru'))
                ->with('success', 'Welcome back, Admin!');
        } else {
            $riwayatAbsensi = $user->absensis()
                ->with('modul')
                ->latest()
                ->take(5)
                ->get();
            
            return view('dashboard', compact('riwayatAbsensi'))
                ->with('success', 'Welcome back, Assistant!');
        }
    })->name('dashboard');

    // Resource Routes
    Route::resource('modul', ModulController::class);
    Route::resource('absensi', AbsensiController::class)
        ->except(['destroy', 'edit']);

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    // Transfer Gaji
    Route::get('/transfer', [\App\Http\Controllers\TransferController::class, 'index'])->name('transfer.index');
    Route::middleware('can:admin')->group(function () {
        Route::get('/transfer/create', [\App\Http\Controllers\TransferController::class, 'create'])->name('transfer.create');
        Route::post('/transfer', [\App\Http\Controllers\TransferController::class, 'store'])->name('transfer.store');
    });

    // Admin Only Routes
    Route::middleware('can:admin')->group(function () {
        Route::resource('users', UserController::class);
    });
});

require __DIR__.'/auth.php';
