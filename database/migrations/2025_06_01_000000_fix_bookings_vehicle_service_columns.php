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
        Schema::table('bookings', function (Blueprint $table) {
            // Add vehicle_id and service_id columns
            $table->unsignedBigInteger('vehicle_id')->nullable()->after('user_id');
            $table->unsignedBigInteger('service_id')->nullable()->after('vehicle_id');

            // Add foreign key constraints
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('set null');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('set null');

            // Drop the string columns vehicle and service
            if (Schema::hasColumn('bookings', 'vehicle')) {
                $table->dropColumn('vehicle');
            }
            if (Schema::hasColumn('bookings', 'service')) {
                $table->dropColumn('service');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Add back the string columns
            $table->string('vehicle')->nullable()->after('user_id');
            $table->string('service')->nullable()->after('vehicle');

            // Drop foreign keys and columns
            $table->dropForeign(['vehicle_id']);
            $table->dropForeign(['service_id']);
            $table->dropColumn(['vehicle_id', 'service_id']);
        });
    }
};
