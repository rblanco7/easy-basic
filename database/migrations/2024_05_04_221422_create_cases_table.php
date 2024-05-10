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
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicants_id')->constrained(table: 'applicants')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('typecases_id')->constrained(table: 'typecases')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('preparers_id')->constrained(table: 'preparers')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->enum('status',['INITIATED','WAITING', 'CLOSED'])->nullable();
            $table->foreignId('users_id')->constrained(table: 'users')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cases');
    }
};
