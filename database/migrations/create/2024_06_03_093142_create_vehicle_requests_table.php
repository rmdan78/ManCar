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
        Schema::create('vehicle_requests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('vehicle_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('status_id')->constrained('vehicle_request_statuses')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('requester_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('processor_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('code', 20)->unique();
            $table->string('description');
            $table->string('destination');
            $table->datetime('used_on');
            $table->datetime('ends_on');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_requests');
    }
};
