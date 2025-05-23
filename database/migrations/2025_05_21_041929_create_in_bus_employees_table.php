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
        Schema::create('in_bus_employees', function (Blueprint $table) {
            $table->id();
            $table->string('license_no')->unique();
            $table->string('name');
            $table->integer('age');
            $table->string('contact_no');
            $table->enum('in_bus_role', ['driver', 'konductor']);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('in_bus_employees');
    }
};
