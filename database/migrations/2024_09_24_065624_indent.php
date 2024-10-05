<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('indents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicine_id')->constrained();
            $table->string('medicine_name');
            $table->string('generic_name');
            $table->unsignedInteger('quantity'); // Assuming quantities should be non-negative
            $table->date('indent_date');
            $table->enum('indent_status', ['Active', 'Inactive']); // Enum for better control over status
            $table->string('indent_remarks')->nullable();
            $table->unsignedInteger('previous_quantity')->nullable(); // Nullable and non-negative
            $table->string('batch_number')->nullable(); // Changed from "batch no." to follow naming conventions
            $table->date('expiry_date')->nullable();
            $table->boolean('received')->default(false);
            $table->foreignId('user_id')->constrained();
            $table->boolean('is_returned')->default(false);
            $table->timestamps();

            // Indexing common fields for performance
            $table->index('medicine_id');
            $table->index('indent_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indents');
    }
};
