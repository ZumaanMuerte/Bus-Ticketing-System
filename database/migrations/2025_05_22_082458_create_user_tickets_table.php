<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTicketsTable extends Migration
{
    public function up(): void
    {
        Schema::create('user_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('bus_id')->constrained('buses')->onDelete('cascade');
            $table->date('date');
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade');
            $table->foreignId('destination_id')->constrained('locations')->onDelete('cascade');
            $table->enum('discount', ['none', 'student', 'senior', 'pwd'])->default('none');
            $table->decimal('final_fare', 8, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_tickets');
    }
}

