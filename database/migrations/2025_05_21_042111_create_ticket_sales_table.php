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
        Schema::create('ticket_sales', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('bus_id')->constrained();
            $table->foreignId('driver_id')->constrained('in_bus_employees');
            $table->foreignId('konductor_id')->constrained('in_bus_employees');
            $table->integer('total_passengers');
            $table->decimal('sales', 10, 2);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_sales');
    }
};
