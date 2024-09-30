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
        Schema::create('indents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicine_id')->constrained(); // Assuming 'medicine' table exists
            $table->string('medicine_name');
            $table->string('generic_name');
            $table->integer('quantity');
            $table->integer('indent_quantity');
            $table->integer('indent_amount');
            $table->date('indent_date'); // Change to 'date' type
            $table->string('indent_status'); // You could use an enum if you want strict status control
            $table->string('indent_remarks')->nullable(); // Make this nullable if not required
            $table->integer('previous_quantity')->nullable(); // Nullable if optional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indents');
    }
};
