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
        Schema::create('fare_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fare_id')->nullable(false);
            $table->unsignedBigInteger('account_id')->nullable(false);
            $table->integer('nominal')->nullable(false)->default(0);

            $table->foreign('fare_id')->references('id')->on('fares')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('payment_accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fare_details');
    }
};
