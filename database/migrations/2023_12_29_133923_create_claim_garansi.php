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
        Schema::create('claim_garansi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->string('nomor_garansi');
            $table->string('nama');
            $table->string('nomor_hp');
            $table->string('alamat_penerima');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('rt_rw')->nullable();
            $table->string('kode_pos');
            $table->string('alasan_kerusakan');
            $table->string('foto_tipe_barang');
            $table->string('foto_stiker');
            $table->string('foto_kerusakan');
            $table->string('foto_struk_pembelian');
            $table->string('model_barang');
            $table->string('jenis_barang');
            $table->date('tanggal_pembelian');
            $table->enum('metode_pembelian', ['Online', 'Offline']);
            $table->string('nama_toko');
            $table->text('keterangan_tambahan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claim_garansi');
    }
};
