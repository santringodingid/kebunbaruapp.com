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
        Schema::create('registrations', function (Blueprint $table) {
            $table->string('id', 8)->nullable(false)->primary();
            $table->boolean('domicile_status')->nullable(false)->default(1)->comment('1: P2K | 0: LP2K');
            $table->string('domicile', 100)->nullable(false);
            $table->string('domicile_number', 3)->nullable();
            $table->boolean('is_new_domicile')->nullable(false)->default(0)->comment('1: NEW | 0: OLD');
            $table->string('grade_of_diniyah', 50)->nullable(false);
            $table->unsignedBigInteger('institution_diniyah_id')->nullable()->default(0);
            $table->boolean('is_new_diniyah')->nullable(false)->default(0)->comment('1: NEW | 0: OLD');
            $table->string('grade_of_formal', 50)->nullable(false);
            $table->unsignedBigInteger('institution_formal_id')->nullable()->default(0);
            $table->boolean('is_new_formal')->nullable(false)->default(0)->comment('1: NEW | 0: OLD');
            $table->string('created_at_hijri', 10)->nullable(false);
            $table->timestamps();

            $table->foreign('id')->on('students')->references('id')->onDelete('cascade');
            $table->foreign('institution_diniyah_id')->on('institutions')->references('id')->onDelete('cascade');
            $table->foreign('institution_formal_id')->on('institutions')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
