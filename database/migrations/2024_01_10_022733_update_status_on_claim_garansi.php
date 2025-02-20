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
            $table->dropColumn('status');
        });
        Schema::table('claim_garansi', function (Blueprint $table) {
            $table->string('status')->after('qr_code')->default('PENDING');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('claim_garansi', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('claim_garansi', function (Blueprint $table) {
            $table->enum('status', ['PENDING', 'IN PROGRESS', 'APPROVED'])->after('qr_code')->default('pending');
        });
    }
};
