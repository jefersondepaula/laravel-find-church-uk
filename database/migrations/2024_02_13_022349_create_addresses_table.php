<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('church_id')->constrained()->onDelete('cascade'); // Assumindo a relação com uma igreja
            $table->string('address_line1');
            $table->string('address_line2')->nullable(); // Opcional
            $table->string('town');
            $table->string('county');
            $table->string('post_code');
            $table->decimal('latitude', 10, 8)->nullable(); // Para geolocalização
            $table->decimal('longitude', 11, 8)->nullable(); // Para geolocalização
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
