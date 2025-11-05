<?php

use App\Models\Vehicle\Transaction\Transaction;
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
            $table->dropForeign('vehicle_transactions_processor_id_foreign');
            $table->dropIndex('vehicle_transactions_processor_id_foreign');
            $table->renameColumn('processor_id', 'approver_id');
        });

        Schema::table('vehicle_transactions', function (Blueprint $table) {
            $table->foreignUuid('approver_id')->nullable()->after('status_id')->change();
            $table->foreign('approver_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicle_transactions', function (Blueprint $table) {
            $table->dropForeign('vehicle_transactions_approver_id_foreign');
            $table->dropIndex('vehicle_transactions_approver_id_foreign');
            $table->renameColumn('approver_id', 'processor_id');
        });

        Schema::table('vehicle_transactions', function (Blueprint $table) {
            $table->foreignUuid('processor_id')->after('requester_id')->change();
            $table->foreign('processor_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }
};
