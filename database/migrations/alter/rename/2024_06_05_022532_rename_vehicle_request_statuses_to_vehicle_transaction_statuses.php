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
        $oldTableName = 'vehicle_request_statuses';
        $newTableName = 'vehicle_transaction_statuses';

        Schema::table($oldTableName, function (Blueprint $table) use($oldTableName, $newTableName) {
            $table->dropUnique($oldTableName . '_codename_unique');
            $table->rename($newTableName);
        });

        Schema::table($newTableName, function (Blueprint $table) {
            $table->unique('codename');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $oldTableName = 'vehicle_transaction_statuses';
        $newTableName = 'vehicle_request_statuses';

        Schema::table($oldTableName, function (Blueprint $table) use($oldTableName, $newTableName) {
            $table->dropUnique($oldTableName . '_codename_unique');
            $table->rename($newTableName);
        });

        Schema::table($newTableName, function (Blueprint $table) {
            $table->unique('codename');
        });
    }
};
