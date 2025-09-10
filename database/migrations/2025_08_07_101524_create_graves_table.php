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
        Schema::create('graves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->constrained('grave_sites')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('cluster_id')->constrained('grave_clusters')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('block_id')->constrained('grave_blocks')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('type_id')->constrained('grave_types')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedInteger('number')->default(1);
            $table->string('code')->unique();
            $table->enum('status', ['available', 'reserved', 'sold'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graves');
    }
};
