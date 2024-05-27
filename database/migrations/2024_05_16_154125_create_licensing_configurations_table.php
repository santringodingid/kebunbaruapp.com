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
        Schema::create('licensing_configurations', function (Blueprint $table) {
            $table->id();
            $table->boolean('gender')->default(false)->comment('0: male | 1: female');
            $table->string('kamtib', 255)->nullable(false);
            $table->string('health', 255)->nullable(false);
            $table->string('guardian', 255)->nullable(false);
            $table->string('kabid', 255)->nullable(false);
            $table->string('chief', 255)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licensing_configurations');
    }
};
