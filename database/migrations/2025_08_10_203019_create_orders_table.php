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
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_agreement_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('type_id')->constrained('grave_types')->onDelete('cascade');
            $table->foreignId('cluster_id')->constrained('grave_clusters')->onDelete('cascade');
            $table->foreignId('block_id')->constrained('grave_blocks')->onDelete('cascade');
            $table->foreignId('grave_id')->constrained('graves')->onDelete('cascade');
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
