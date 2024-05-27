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
        Schema::create('petition_recapitulations', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->boolean('gender')->default(false);
            $table->string('period', 2);
            $table->string('status', 1)->default(0)->comment('0:pending, 1:process, 2:completed');

            $table->foreign('id')->references('id')->on('petitions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petition_recapitulations');
    }
};
