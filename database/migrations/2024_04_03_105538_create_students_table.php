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
        Schema::create('students', function (Blueprint $table) {
            $table->string('id', 8)->nullable(false)->primary();
            $table->integer('registration_number')->nullable(false)->unique();
            $table->boolean('gender')->nullable(false)->comment('0: male | 1: female');
            $table->unsignedBigInteger('period_id', false)->nullable(false);
            $table->string('nik', 16)->nullable(false)->unique();
            $table->string('kk', 16)->nullable(false);
            $table->string('name')->nullable(false);
            $table->string('place_of_birth', 100)->nullable(false);
            $table->date('date_of_birth')->nullable(false);
            $table->string('address', 100)->nullable(false);
            $table->string('region_id', 10)->nullable(false);
            $table->string('last_education', 100)->nullable(false);
            $table->boolean('domicile_status')->nullable(false)->default(1)->comment('1: P2K | 0: LP2K');
            $table->string('domicile', 100)->nullable(false);
            $table->string('domicile_number', 3)->nullable();
            $table->string('grade_of_diniyah', 50)->nullable(true);
            $table->unsignedBigInteger('institution_diniyah_id')->nullable(true)->default(0);
            $table->string('grade_of_formal', 50)->nullable(false);
            $table->unsignedBigInteger('institution_formal_id')->nullable(true)->default(0);
            $table->string('father')->nullable(false);
            $table->string('mother')->nullable(false);
            $table->string('guardian_id', 10)->nullable(false);
            $table->string('guardian_relationship', 100)->nullable(false);
            $table->string('committee')->nullable(false);
            $table->string('image_of_profile')->nullable();
            $table->string('image_of_signature')->nullable();
            $table->string('status')->nullable(false)->default(0)->comment('0: QUITED | 1: ACTIVE | 2: ASSIGNED');
            $table->string('created_at_hijri', 10)->nullable(false);
            $table->timestamps();

            $table->foreign('region_id')->on('regions')->references('id')->onDelete('cascade');
            $table->foreign('institution_diniyah_id')->on('institutions')->references('id')->onDelete('cascade');
            $table->foreign('institution_formal_id')->on('institutions')->references('id')->onDelete('cascade');
            $table->foreign('guardian_id')->on('guardians')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
