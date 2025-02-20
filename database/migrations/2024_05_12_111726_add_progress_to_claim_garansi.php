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
            $table->enum('progress', ['PENGECEKAN UNIT', 'PERGANTIAN UNIT', 'PENGIRIMAN UNIT'])->after('status')->default('PENGECEKAN UNIT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('claim_garansi', function (Blueprint $table) {
            $table->dropColumn('progress');
        });
    }
};
