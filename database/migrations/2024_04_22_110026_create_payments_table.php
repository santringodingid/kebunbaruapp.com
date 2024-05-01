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
        Schema::create('payments', function (Blueprint $table) {
            $table->string('id', 14)->nullable(false)->primary();
            $table->string('registration_id', 8)->nullable(false);
            $table->unsignedBigInteger('institution_id')->nullable(false);
            $table->integer('fare')->nullable(true)->default(0);
            $table->integer('registration')->nullable(true)->default(0);
            $table->integer('amount')->nullable(true)->default(0);
            $table->boolean('is_paid')->nullable(true)->default(true);
            $table->text('notes')->nullable();
            $table->string('created_at_hijri', 10)->nullable(false);
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->timestamps();

            $table->foreign('registration_id')->references('id')->on('registrations')->onDelete('cascade');
            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
