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
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kamar');
            $table->unsignedBigInteger('tipe_kamar_id');
            $table->text('deskripsi');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('tipe_kamar_id')->references('id')->on('tipe_kamars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};
