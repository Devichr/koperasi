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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
        $table->unsignedBigInteger('loanId');
        $table->decimal('amount', 15, 2);
        $table->unsignedBigInteger('memberId');
        $table->unsignedBigInteger('notedBy');
        $table->timestamp('paymentDate');
        $table->timestamps();

        $table->foreign('loanId')->references('id')->on('loans');
        $table->foreign('memberId')->references('id')->on('users');
        $table->foreign('notedBy')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
