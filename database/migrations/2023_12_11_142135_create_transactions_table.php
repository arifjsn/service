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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->string('invoice');
            $table->string('input_date');
            $table->string('output_date')->nullable();
            $table->string('item_name');
            $table->string('item_user')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('equipment')->nullable();
            $table->string('complaint')->nullable();
            $table->string('information')->nullable();
            $table->string('technician')->nullable();
            $table->string('taker')->nullable();
            $table->string('sender')->nullable();
            $table->enum('status', ['Not Started', 'In Progress', 'Pending', 'Done', 'Canceled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
