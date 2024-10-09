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
            $table->enum('log_type', ['received', 'returned', 'pending'])->default('pending');
            $table->foreignId('medicine_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('quantity');
            $table->date('date');
            $table->string('notes')->nullable();
            $table->foreignId('ref_id')->nullable()->constrained('indents')->onDelete('set null');
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
