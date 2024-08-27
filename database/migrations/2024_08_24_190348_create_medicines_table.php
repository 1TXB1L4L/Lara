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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('med_name');
            $table->string('med_description')->nullable();
            $table->string('med_generic_name')->required();
            $table->integer('med_quantity')->nullable();
            $table->integer('med_price')->nullable()->default(0);
            $table->string('med_batch_no')->nullable();
            $table->string('med_dosage')->nullable();
            $table->string('med_strength')->nullable();
            $table->string('med_route')->nullable();
            $table->string('med_therapeutic_class')->nullable();
            $table->string('med_notes')->nullable();
            $table->date('med_expiry_date')->nullable();
            $table->string('med_category')->nullable();
            $table->string('med_manufacturer')->nullable();
            $table->boolean('med_status')->default(1)->comment('1=Active, 0=Inactive');
            $table->string('med_image')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
