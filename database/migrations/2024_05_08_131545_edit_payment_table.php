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
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('notes');

            $table->text('payment_notes')->nullable(true)->after('registration');
            $table->integer('payment_amount')->nullable(false)->default(0)->after('payment_notes');
            $table->text('reduction_notes')->nullable()->after('payment_amount');
            $table->integer('reduction_amount')->nullable()->default(0)->after('reduction_notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->text('notes')->nullable();

            $table->dropColumn('payment_notes');
            $table->dropColumn('payment_amount');
            $table->dropColumn('reduction_notes');
            $table->dropColumn('reduction_amount');
        });
    }
};
