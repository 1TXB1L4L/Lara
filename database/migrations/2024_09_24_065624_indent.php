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
            $table->unsignedInteger('quantity'); 
            $table->date('indent_date');
            $table->string('indent_status');
            $table->string('notes')->nullable();
            $table->string('is_received')->default(0);
            $table->foreignId('user_id')->constrained();
            $table->string('is_returned')->default(0);
            $table->string('returned_reason')->nullable();
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
