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
        Schema::create('guardian_cards', function (Blueprint $table) {
            $table->string('id', 15)->primary();
            $table->string('guardian_id', 8)->nullable(false);
            $table->dateTime('created_at')->nullable(false)->useCurrent();
            $table->unsignedBigInteger('created_by')->nullable(false);
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->foreign('guardian_id')->references('id')->on('guardians')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardian_cards');
    }
};
