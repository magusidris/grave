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
        Schema::create('grave_block_limits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('block_id')->constrained('grave_blocks')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('cluster_id')->constrained('grave_clusters')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedTinyInteger('limit')->default(20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grave_block_limits');
    }
};
