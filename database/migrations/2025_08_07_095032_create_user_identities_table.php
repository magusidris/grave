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
        Schema::create('user_identities', function (Blueprint $table) {
            $table->id();
            $table->string('photo')->nullable();
            $table->morphs('model');
            $table->foreignId('identity_type_id')->constrained('master_identity_types')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('identity_number')->unique();
            $table->foreignId('province_id')->nullable()->constrained('master_provinces')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('city_id')->nullable()->constrained('master_cities')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('subdistrict_id')->nullable()->constrained('master_subdistricts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->text('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_identities');
    }
};
