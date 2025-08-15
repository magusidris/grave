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
            $table->string('code')->unique();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('phone');
            $table->foreignId('province_id')->nullable()->constrained('master_provinces')->onDelete('cascade');
            $table->foreignId('city_id')->nullable()->constrained('master_cities')->onDelete('cascade');
            $table->foreignId('subdistrict_id')->nullable()->constrained('master_subdistricts')->onDelete('cascade');
            $table->text('address');
            $table->unsignedBigInteger('grand_total');
            $table->unsignedBigInteger('down_payment');
            $table->unsignedTinyInteger('tenor');
            $table->unsignedBigInteger('installment_amount');
            $table->date('last_payment_date');
            $table->enum('status', ['active', 'completed', 'overdue', 'cancelled'])->default('active');
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
