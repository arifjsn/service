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
        Schema::create('registrasi_garansi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->string('nama');
            $table->string('nomor_hp');
            $table->string('email');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('rt_rw')->nullable();
            $table->integer('kode_pos');
            $table->string('struk_pembelian');
            $table->string('model_barang');
            $table->string('jenis_barang');
            $table->date('tanggal_pembelian');
            $table->enum('metode_pembelian', ['Online', 'Offline']);
            $table->string('nama_toko');
            $table->text('keterangan_tambahan')->nullable();
            $table->string('qr_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrasi_garansi');
    }
};
