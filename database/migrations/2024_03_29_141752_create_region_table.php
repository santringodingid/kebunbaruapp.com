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
        Schema::create('provinces', function (Blueprint $table) {
            $table->string('id', 2)->nullable(false)->primary();
            $table->string('name');
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->string('id', 4)->nullable(false)->primary();
            $table->string('province_id', 2)->nullable(false);
            $table->string('name');

            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
        });

        Schema::create('districts', function (Blueprint $table) {
            $table->string('id', 8)->nullable(false)->primary();
            $table->string('city_id', 4)->nullable(false);
            $table->string('name');

            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });

        Schema::create('villages', function (Blueprint $table) {
            $table->string('id', 15)->nullable(false)->primary();
            $table->string('district_id', 8)->nullable(false);
            $table->string('name');
            $table->string('portal_code', 10);

            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
        });

        Schema::create('regions', function (Blueprint $table) {
            $table->string('id', 15)->nullable(false)->primary();
            $table->string('village', 200)->nullable(false);
            $table->string('district', 200)->nullable(false);
            $table->string('city', 200)->nullable(false);
            $table->string('province', 200)->nullable(false);
            $table->string('portal_code', 200)->nullable(false);

            $table->foreign('id')->references('id')->on('villages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provinces');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('districts');
        Schema::dropIfExists('villages');
        Schema::dropIfExists('regions');
    }
};
