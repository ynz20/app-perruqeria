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
            $table->string('user_id', 255);
            $table->foreign('user_id')->references('dni')->on('users'); // Afegeix la clau forana
            $table->foreignId('service_id')->constrained('services');
            $table->date('reservation_date');
            $table->time('reservation_time');
            $table->time('reservation_finalitzation');
            $table->string('status')->default('pendent');
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
