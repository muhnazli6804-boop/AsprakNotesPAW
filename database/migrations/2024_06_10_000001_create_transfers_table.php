<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('no action'); // asprak
            $table->decimal('nominal', 12, 2);
            $table->string('keterangan')->nullable();
            $table->date('tanggal');
            $table->enum('status', ['selesai'])->default('selesai');
            $table->foreignId('absensi_id')->nullable()->constrained('absensis')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
