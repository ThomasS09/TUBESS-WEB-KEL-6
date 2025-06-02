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
            // Hapus foreign key constraints jika ada
            if (Schema::hasColumn('bookings', 'vehicle_id')) {
                $table->dropForeign(['vehicle_id']);
                $table->dropColumn('vehicle_id');
            }

            if (Schema::hasColumn('bookings', 'service_id')) {
                $table->dropForeign(['service_id']);
                $table->dropColumn('service_id');
            }

            // Tambahkan kolom string
            $table->string('vehicle')->nullable();
            $table->string('service')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();

            // Tambahkan kembali foreign key
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('set null');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('set null');

            $table->dropColumn('vehicle');
            $table->dropColumn('service');
        });
    }
};
