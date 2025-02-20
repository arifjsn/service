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
            $table->string('no_invoice')->after('struk_pembelian');
        });

        Schema::table('claim_garansi', function (Blueprint $table) {
            $table->string('no_invoice')->after('foto_struk_pembelian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrasi_garansi', function (Blueprint $table) {
            $table->dropColumn('no_invoice');
        });

        Schema::table('claim_garansi', function (Blueprint $table) {
            $table->dropColumn('no_invoice');
        });
    }
};
