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
        Schema::table('reduction_details', function (Blueprint $table) {
            $table->dropColumn('nominal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reduction_details', function (Blueprint $table) {
            $table->integer('nominal')->after('account_id')->nullable(false)->default(0);
        });
    }
};
