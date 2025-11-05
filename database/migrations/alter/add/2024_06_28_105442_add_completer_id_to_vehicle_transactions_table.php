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
        Schema::table('vehicle_transactions', function (Blueprint $table) {
            $table->foreignUuid('completer_id')->nullable()->after('approver_id')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicle_transactions', function (Blueprint $table) {
            $table->dropForeign('vehicle_transactions_completer_id_foreign');
            $table->dropIndex('vehicle_transactions_completer_id_foreign');
            $table->dropColumn('completer_id');
        });
    }
};
