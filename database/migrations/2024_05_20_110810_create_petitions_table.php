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
        Schema::create('petitions', function (Blueprint $table) {
            $table->string('id', 7)->nullable(false)->primary();
            $table->string('reg_number', 50)->nullable(false);
            $table->string('registration_id', 8)->nullable(false);
            $table->string('reason', 255)->nullable(false);
            $table->string('note', 255)->nullable(false);
            $table->boolean('is_health')->nullable(false)->default(false);
            $table->string('status', 1)->default(1)->comment('0:expired, 1:pending, 2: ongoing, 3: completed');
            $table->string('created_at_hijri', 20)->nullable(false);
            $table->unsignedBigInteger('created_by')->nullable(false);
            $table->timestamps();
            $table->timestamp('expired_at')->nullable(false);

            $table->foreign('registration_id')->references('id')->on('registrations')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petitions');
    }
};
