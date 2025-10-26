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
Schema::create('reminders', function (Blueprint $table) {
    $table->id();
    $table->string('titulo');
    $table->string('descricao');
    $table->date('data_lembrete');
    $table->time('hora_lembrete');
    $table->unsignedBigInteger('user_id'); // Adicionado!
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders'); 
    }
};