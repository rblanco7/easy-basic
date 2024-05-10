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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('email')->unique();
            $table->string('telephone')->nullable();
            $table->string('movil')->nullable();
            $table->string('number_alien')->nullable();
            $table->enum('gender',['FEMALE','MALE'])->nullable();
            // Datos de Nacimiento
            $table->date('date_birth')->nullable(); //fecha de nacimiento
           // $table->integer('country_id_birth')->nullable(); //pais de nacimiento
            $table->foreignId('country_id_birth')->constrained(table: 'countries')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('state_id_birth')->constrained(table: 'states')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('city_id_birth')->constrained(table: 'cities')->onUpdate('cascade')->onDelete('cascade')->nullable();

           // $table->integer('city_id_birth')->nullable();  //ciudad de nacimiento
            $table->string('ssn')->nullable();  //Numero de Seguro Social
                //Datos Direccion de envio
            $table->string('street_number_mail')->nullable();
            $table->enum('type_home_mail',['APT','STE', 'FLR'])->nullable();
            $table->string('number_home_mail')->nullable();
            $table->foreignId('city_id_mail')->constrained(table: 'cities')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('state_id_mail')->constrained(table: 'states')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('country_id_mail')->constrained(table: 'countries')->onUpdate('cascade')->onDelete('cascade')->nullable();

           /* $table->integer('city_id_mail')->nullable(); // Ciudad
            $table->integer('state_id_mail')->nullable();  //Estado
            $table->integer('country_id_mail')->nullable(); //Pais*/
            $table->string('postal_code_mail')->nullable(); //Codigo Postal
            $table->string('zip_code_mail')->nullable();
            $table->string('province_mail')->nullable(); //Provincia
                 //Datos Direccion Fisica
            $table->string('street_number_physi')->nullable();
            $table->string('type_home_physi')->nullable();
            $table->string('number_home_physi')->nullable();
            $table->foreignId('city_id_physi')->constrained(table: 'cities')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('state_id_physi')->constrained(table: 'states')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('country_id_physi')->constrained(table: 'countries')->onUpdate('cascade')->onDelete('cascade')->nullable();

            /*$table->integer('city_id_physi')->nullable(); // Ciudad
            $table->integer('state_id_physi')->nullable();  //Estado
            $table->integer('country_id_physi')->nullable(); //Pais*/
            $table->string('postal_code_physi')->nullable(); //Codigo Postal
            $table->string('zip_code_physi')->nullable();
            $table->string('province_physi')->nullable(); //Provincia
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant');
    }
};
