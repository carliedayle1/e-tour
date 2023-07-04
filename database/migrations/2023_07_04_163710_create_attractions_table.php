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
        Schema::create('attractions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('open_time');
            $table->string('image');
            $table->unsignedDouble('time');
            $table->unsignedDouble('fee');
            $table->unsignedDouble('region');
            $table->string('region_text');
            $table->unsignedDouble('province');
            $table->string('province_text');
            $table->unsignedDouble('city');
            $table->string('city_text');
            $table->unsignedDouble('barangay')->nullable();
            $table->string('barangay_text')->nullable();
            $table->string('street')->nullable();
            $table->unsignedDouble('longitude');
            $table->unsignedDouble('latitude');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attractions');
    }
};
