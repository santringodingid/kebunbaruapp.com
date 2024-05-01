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
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable(false)->unique();
            $table->string('name')->nullable(false);
            $table->string('chief')->nullable();
            $table->string('secretary')->nullable();
            $table->string('treasurer')->nullable();
            $table->string('commission', 100)->nullable(false);
            $table->char('gender_access', 1)->nullable(false)->default(0)->comment('0: male | 1: female | 2: general');
            $table->char('status_access', 1)->nullable(false)->default(0)->comment('0: general | 1: diniyah | 2: ammiyah');
            $table->boolean('status', 1)->nullable(false)->default(0)->comment('0: instansi pendidikan | 1: instansi lainnya');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institution');
    }
};
