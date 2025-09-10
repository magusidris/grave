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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('site_id')->constrained('grave_sites')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('type_id')->constrained('grave_types')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('cluster_id')->constrained('grave_clusters')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('block_id')->constrained('grave_blocks')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('grave_id')->constrained('graves')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('unit_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
