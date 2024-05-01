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
        Schema::create('fares', function (Blueprint $table) {
            $table->id();
            $table->string('grade', 100)->nullable(false);
            $table->unsignedBigInteger('institution_id')->nullable(false);
            $table->boolean('domicile_status')->nullable(false)->default(1)->comment('1: P2K | 0: LP2K');
            $table->integer('amount')->nullable(false)->default(0);

            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fares');
    }
};
