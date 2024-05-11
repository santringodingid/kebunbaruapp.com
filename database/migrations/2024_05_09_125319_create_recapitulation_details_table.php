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
        Schema::create('recapitulation_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recapitulation_id')->nullable(false);
            $table->string('payment_id', 14)->nullable(false);
            $table->unsignedBigInteger('account_id')->nullable(false);
            $table->integer('nominal')->nullable(false)->default(0);

            $table->foreign('recapitulation_id')->references('id')->on('recapitulations')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('payment_accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recapitulation_details');
    }
};
