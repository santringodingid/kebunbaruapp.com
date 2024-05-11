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
        Schema::create('recapitulations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('period_id')->nullable(false);
            $table->unsignedBigInteger('institution_id')->nullable(false);
            $table->string('period', 2)->nullable(false)->comment('Bulan Hijriah');
            $table->boolean('gender')->nullable(false)->comment('0 male, 1 female');
            $table->integer('amount')->nullable(false)->default(0);
            $table->timestamps();

            $table->foreign('period_id')->references('id')->on('periods')->onDelete('cascade');
            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recapitulations');
    }
};
