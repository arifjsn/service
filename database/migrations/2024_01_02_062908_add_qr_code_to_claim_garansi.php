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
        Schema::table('claim_garansi', function (Blueprint $table) {
            $table->string('email')->after('nomor_hp');
            $table->string('qr_code')->after('keterangan_tambahan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('claim_garansi', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('qr_code');
        });
    }
};
