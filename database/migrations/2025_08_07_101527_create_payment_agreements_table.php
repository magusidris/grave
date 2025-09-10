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
        Schema::create('payment_agreements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('site_id')->constrained('grave_sites')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name');
            $table->string('phone');
            $table->foreignId('province_id')->nullable()->constrained('master_provinces')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('city_id')->nullable()->constrained('master_cities')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('subdistrict_id')->nullable()->constrained('master_subdistricts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->text('address')->nullable();
            $table->unsignedBigInteger('grand_total');
            $table->unsignedBigInteger('down_payment');
            $table->unsignedTinyInteger('tenor');
            $table->unsignedBigInteger('installment_amount');
            $table->date('agreement_date');
            $table->date('last_payment_date');
            $table->enum('status', ['active', 'completed', 'overdue', 'cancelled'])->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_agreements');
    }
};
