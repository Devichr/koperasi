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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 15, 2);
            $table->string('status'); //'pending','approved','rejected'
            $table->unsignedBigInteger('memberId');
            $table->unsignedBigInteger('verifiedBy')->nullable();
            $table->unsignedBigInteger('approvedBy')->nullable();
            $table->timestamps();
    
            $table->foreign('memberId')->references('id')->on('users');
            $table->foreign('verifiedBy')->references('id')->on('users');
            $table->foreign('approvedBy')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
