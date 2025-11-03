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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('vehicle_model_id')->constrained('vehicle_models')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('color_id')->constrained('colors')->cascadeOnUpdate()->restrictOnDelete();
            $table->year('year');
            $table->unsignedInteger('mileage');
            $table->decimal('price', 12, 2);
            $table->string('main_image_url');
            $table->text('description');
            $table->foreignId('created_by')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};

