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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice')->unique();
            $table->foreignId('status_id')->constrained('invoice_statuses')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('name');
            $table->string('phone');
            $table->foreignId('province_id')->nullable()->constrained('master_provinces')->onDelete('cascade');
            $table->foreignId('city_id')->nullable()->constrained('master_cities')->onDelete('cascade');
            $table->foreignId('subdistrict_id')->nullable()->constrained('master_subdistricts')->onDelete('cascade');
            $table->text('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
