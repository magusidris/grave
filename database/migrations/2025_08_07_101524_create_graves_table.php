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
            $table->foreignId('type_id')->constrained('grave_types')->onDelete('cascade');
            $table->foreignId('cluster_id')->constrained('grave_clusters')->onDelete('cascade');
            $table->foreignId('block_id')->constrained('grave_blocks')->onDelete('cascade');
            $table->unsignedTinyInteger('number')->default(1);
            $table->boolean('is_available')->default(true);
            $table->boolean('is_occupied')->default(false);
            $table->boolean('is_fully_paid')->default(false);
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
