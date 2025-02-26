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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Utilisateur qui aime le post
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // Post aimé
            $table->timestamps();

            $table->unique(['user_id', 'post_id']); // Empêcher un utilisateur de liker plusieurs fois le même post
        });
    }

    public function down()
    {
        Schema::dropIfExists('likes');
    }

};
