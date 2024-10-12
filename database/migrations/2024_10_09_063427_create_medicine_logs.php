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
        Schema::create('medicine_logs', function (Blueprint $table) {
            $table->id();
            $table->enum('log_type', ['approve', 'reject', 'panding', 'return'])->default('pending');
            $table->foreignId('medicine_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('quantity');
            $table->date('date');
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicine_logs');
    }
};
