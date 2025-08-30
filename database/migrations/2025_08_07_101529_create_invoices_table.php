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
            $table->string('code')->unique();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('payment_agreement_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('installment_schedule_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->enum('status', ['draft', 'sent', 'paid', 'overdue', 'void'])->default('draft');
            $table->unsignedBigInteger('total_amount');
            $table->date('due_date');
            $table->text('notes')->nullable();
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
