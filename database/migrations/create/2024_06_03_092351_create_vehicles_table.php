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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('status_id')->constrained('vehicle_statuses')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('kind_id')->constrained('vehicle_kinds')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name');
            $table->string('description');
            $table->string('color', 8);
            $table->string('number_plate');
            $table->datetime('bought_on');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
