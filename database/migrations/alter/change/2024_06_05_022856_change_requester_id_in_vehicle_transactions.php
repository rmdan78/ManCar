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
            $table->dropForeign('vehicle_transactions_requester_id_foreign');
            $table->dropIndex('vehicle_transactions_requester_id_foreign');
            $table->renameColumn('requester_id', 'user_id');
        });

        Schema::table('vehicle_transactions', function (Blueprint $table) {
            $table->foreignUuid('user_id')->after('id')->change();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicle_transactions', function (Blueprint $table) {
            $table->dropForeign('vehicle_transactions_user_id_foreign');
            $table->dropIndex('vehicle_transactions_user_id_foreign');
            $table->renameColumn('user_id', 'requester_id');
        });

        Schema::table('vehicle_transactions', function (Blueprint $table) {
            $table->foreignUuid('requester_id')->after('status_id')->change();
            $table->foreign('requester_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }
};
