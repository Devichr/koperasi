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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loanId')->nullable();
            $table->unsignedBigInteger('paymentId')->nullable();
            $table->unsignedBigInteger('memberId');
            $table->timestamp('reportDate');
            $table->timestamps();
    
            $table->foreign('loanId')->references('id')->on('loans');
            $table->foreign('paymentId')->references('id')->on('payments');
            $table->foreign('memberId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
