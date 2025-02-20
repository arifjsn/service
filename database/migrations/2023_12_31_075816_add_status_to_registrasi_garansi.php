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
        Schema::table('registrasi_garansi', function (Blueprint $table) {
            $table->string('nomor_garansi')->after('jenis_barang');
            $table->enum('status', ['PENDING', 'IN PROGRESS', 'APPROVED'])->after('qr_code')->default('pending');
        });

        Schema::table('claim_garansi', function (Blueprint $table) {
            $table->enum('status', ['PENDING', 'IN PROGRESS', 'APPROVED'])->after('keterangan_tambahan')->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrasi_garansi', function (Blueprint $table) {
            $table->dropColumn('nomor_garansi');
            $table->dropColumn('status');
        });

        Schema::table('claim_garansi', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
