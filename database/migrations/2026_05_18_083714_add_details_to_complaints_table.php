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
        Schema::table('complaints', function (Blueprint $table) {
            $table->string('block')->nullable();
            $table->string('floor')->nullable();
            $table->string('room_number')->nullable();
            $table->string('area_location')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('preferred_time_slot')->nullable();
            $table->date('availability_date')->nullable();
            $table->boolean('is_urgent')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn([
                'block',
                'floor',
                'room_number',
                'area_location',
                'contact_number',
                'preferred_time_slot',
                'availability_date',
                'is_urgent',
            ]);
        });
    }
};
