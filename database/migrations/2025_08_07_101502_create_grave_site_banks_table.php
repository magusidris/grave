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
        Schema::create('grave_site_banks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->constrained('grave_sites')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('bank_id')->constrained('master_banks')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('account_number');
            $table->string('account_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grave_site_banks');
    }
};
