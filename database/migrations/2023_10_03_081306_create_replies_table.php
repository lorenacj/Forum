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
        Schema::create('replys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('post_id'); // Creamos la columna que hará de clave foránea
            $table->foreign('post_id')->references('id')->on('posts'); // Definición de la clave foránea
            $table->unsignedBigInteger('user_id'); // Creamos la columna que hará de clave foránea
            $table->foreign('user_id')->references('id')->on('users'); // Definición de la clave foránea
            $table->text('reply'); // texto del reply
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
