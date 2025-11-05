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
        $oldTableName = 'vehicle_requests';
        $newTableName = 'vehicle_transactions';

        Schema::table($oldTableName, function (Blueprint $table) use($oldTableName, $newTableName) {
            $table->dropForeign($oldTableName . '_vehicle_id_foreign');
            $table->dropForeign($oldTableName . '_status_id_foreign');
            $table->dropForeign($oldTableName . '_requester_id_foreign');
            $table->dropForeign($oldTableName . '_processor_id_foreign');
            $table->dropIndex($oldTableName . '_vehicle_id_foreign');
            $table->dropIndex($oldTableName . '_status_id_foreign');
            $table->dropIndex($oldTableName . '_requester_id_foreign');
            $table->dropIndex($oldTableName . '_processor_id_foreign');
            $table->dropUnique($oldTableName . '_code_unique');
            $table->rename($newTableName);
        });

        Schema::table($newTableName, function (Blueprint $table) {
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('status_id')->references('id')->on('vehicle_request_statuses')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('requester_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('processor_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unique('code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $oldTableName = 'vehicle_transactions';
        $newTableName = 'vehicle_requests';

        Schema::table($oldTableName, function (Blueprint $table) use($oldTableName, $newTableName) {
            $table->dropForeign($oldTableName . '_vehicle_id_foreign');
            $table->dropForeign($oldTableName . '_status_id_foreign');
            $table->dropForeign($oldTableName . '_requester_id_foreign');
            $table->dropForeign($oldTableName . '_processor_id_foreign');
            $table->dropIndex($oldTableName . '_vehicle_id_foreign');
            $table->dropIndex($oldTableName . '_status_id_foreign');
            $table->dropIndex($oldTableName . '_requester_id_foreign');
            $table->dropIndex($oldTableName . '_processor_id_foreign');
            $table->dropUnique($oldTableName . '_code_unique');
            $table->rename($newTableName);
        });

        Schema::table($newTableName, function (Blueprint $table) {
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('status_id')->references('id')->on('vehicle_request_statuses')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('requester_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('processor_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unique('code');
        });
    }
};
