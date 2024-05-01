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
        Schema::create('status_registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('period_id')->nullable(false);
            $table->string('student_id', 8)->nullable(false);
            $table->string('status')->nullable(false)->default(0)->comment('0: QUITED | 1: ACTIVE | 2: ASSIGNED | 3:ADMINISTRATOR');
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
        Schema::dropIfExists('status_registrations');
    }
};
