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
        Schema::create('incident_vehicle', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable(); // Ezt az attribútumot változtathatod a saját igényeidnek megfelelően
            $table->foreignId('incident_id')->constrained();
            $table->foreignId('vehicle_id')->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incident_vehicle');
    }
};
