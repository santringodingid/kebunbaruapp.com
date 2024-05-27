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
        Schema::create('petition_licenses', function (Blueprint $table) {
            $table->string('id')->nullable(false)->primary();
            $table->timestamp('start_at')->nullable(false);
            $table->timestamp('end_at')->nullable(false);
            $table->timestamp('finish_at')->nullable();
            $table->string('start_at_hijri')->nullable(false);
            $table->string('end_at_hijri')->nullable(false);
            $table->string('finish_at_hijri')->nullable();
            $table->boolean('is_late')->default(false)->nullable(false);
            $table->boolean('status')->default(0)->nullable(false)->comment('0: pending, 1:ongoing, 2:completed');
            $table->unsignedBigInteger('created_by')->nullable(false);
            $table->unsignedBigInteger('finished_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('finished_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id')->references('id')->on('petitions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petition_licenses');
    }
};
