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
        Schema::create('master_subdistricts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('province_id')->constrained('master_provinces')->onDelete('cascade');
            $table->string('province');
            $table->foreignId('city_id')->constrained('master_cities')->onDelete('cascade');
            $table->string('city');
            $table->enum('type', ['kabupaten', 'kota'])->default('kabupaten');
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_subdistricts');
    }
};
