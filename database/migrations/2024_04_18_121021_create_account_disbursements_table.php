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
        Schema::create('account_disbursements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id')->nullable(false);
            $table->unsignedBigInteger('institution_id')->nullable(true)->default(null)->comment('Jika NOL berarti distribusi ke madrasah');
            $table->boolean('gender')->nullable(false)->comment('0: MALE | 1: FEMALE');

            $table->foreign('account_id')->references('id')->on('payment_accounts')->onDelete('cascade');
            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_disbursements');
    }
};
