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
            $table->foreignId('project_id')->constrained();
            $table->foreignId('client_id')->constrained();
            $table->string('invoice_number')->unique();
            $table->date('issue_date');
            $table->date('due_date');
            $table->unsignedBigInteger('amount')->nullable(false)->default(0);
            $table->enum('status', ['pending', 'drop payment', 'paid', 'cancelled'])->default('pending');
            $table->softDeletes();
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
