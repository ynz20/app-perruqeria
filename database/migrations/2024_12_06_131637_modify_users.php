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
        Schema::table('users', function (Blueprint $table) {
            $table->string('dni')->unique();
            $table->string('surname')->after('name');
            $table->string('nick')->after('surname');
            $table->boolean('is_admin')->default(0);// Afegeix el camp 'role' amb valor per defecte 'user'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin'); // Elimina el camp 'role' si es revoca la migració
            $table->dropColumn('nick'); // Elimina el camp 'nick'
            $table->dropColumn('surname'); // Elimina el camp 'surname'
        });
    }
};
