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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('client_id');
            $table->foreign('client_id')->references('dni')->on('clients');
            $table->string('dni', 255); // Defineix 'dni' com a string
            $table->foreign('dni')->references('dni')->on('users'); // Afegeix la clau forana
            $table->foreignId('service_id')->constrained('services');
            $table->timestamp('reservation_date');
            $table->string('status')->default('pendent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            //
        });
    }
};
