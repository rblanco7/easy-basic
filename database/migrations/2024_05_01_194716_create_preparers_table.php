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
        Schema::create('preparers', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('email')->unique();
            $table->string('telephone')->nullable();
            $table->string('movil')->nullable();
               //Datos Direccion de envio
            $table->string('street_number_mail')->nullable();
            $table->string('type_home_mail')->nullable();
            $table->string('number_home_mail')->nullable();
            $table->integer('city_id_mail')->nullable(); // Ciudad
            $table->integer('state_id_mail')->nullable();  //Estado
            $table->integer('country_id_mail')->nullable(); //Pais
            $table->string('postal_code_mail')->nullable(); //Codigo Postal
            $table->string('zip_code_mail')->nullable();
            $table->string('province_mail')->nullable(); //Provincia
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preparer');
    }
};
