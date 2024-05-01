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
        Schema::create('domicile_registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('period_id')->nullable(false);
            $table->string('student_id', 8)->nullable(false);
            $table->boolean('domicile_status')->nullable(false)->default(1)->comment('1: P2K | 0: LP2K');
            $table->string('domicile', 100)->nullable(false);
            $table->string('domicile_number', 3)->nullable();
            $table->boolean('is_new')->nullable(false)->default(0)->comment('1: NEW | 0: OLD');
            $table->text('note')->nullable();
            $table->string('created_at_hijri', 10)->nullable(false);
            $table->timestamp('created_at')->nullable(false)->useCurrent();

            $table->foreign('period_id')->on('periods')->references('id')->onDelete('cascade');
            $table->foreign('student_id')->on('students')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domicile_registrations');
    }
};
