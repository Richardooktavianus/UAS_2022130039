<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sewa_id')->constrained('sewas')->onDelete('cascade');
            $table->foreignId('penghuni_id')->nullable()->constrained('penghunis')->onDelete('set null');
            $table->timestamp('tanggal_transaksi')->default(now());
            $table->decimal('jumlah_bayar', 10, 2)->default(0);
            $table->string('metode_pembayaran');
            $table->string('status_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};

