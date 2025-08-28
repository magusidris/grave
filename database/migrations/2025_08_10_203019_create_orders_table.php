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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('payment_agreement_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('type_id')->constrained('grave_types')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('cluster_id')->constrained('grave_clusters')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('block_id')->constrained('grave_blocks')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('grave_id')->constrained('graves')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
