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
        Schema::create('grave_sites', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('province_id')->constrained('master_provinces')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('city_id')->constrained('master_cities')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('subdistrict_id')->nullable()->constrained('master_subdistricts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grave_sites');
    }
};
