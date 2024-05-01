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
        Schema::create('guardians', function (Blueprint $table) {
            $table->string('id', 10)->nullable(false)->primary();
            $table->string('nik', 16)->nullable(false)->unique();
            $table->string('name', 200)->nullable(false);
            $table->boolean('gender', 200)->nullable(false)->default(0);
            $table->string('phone', 20)->nullable(true);
            $table->string('wa_number', 20)->nullable(true);
            $table->string('address', 100)->nullable(true);
            $table->string('region_id', 16)->nullable(false);
            $table->string('last_education', 100)->nullable();
            $table->string('employment', 100)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('created_at_hijri', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardians');
    }
};
