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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            /**
             * ====== NOUVELLES COLONNES POUR LE SYSTÈME DE CHAT ======
             */

            // ID de celui qui envoie le message
            $table->unsignedBigInteger('sender_id')->nullable();

            // ID de celui qui reçoit le message (un artiste ou un autre user)
            $table->unsignedBigInteger('receiver_id')->nullable();

            // Pour rattacher les messages à une conversation précise
            $table->unsignedBigInteger('conversation_id')->nullable();

            // Contenu final du message
            $table->text('content')->nullable();


            /**
             * ====== ANCIEN CHAMP DE CONTACT ======
             * Tu peux les conserver ou les supprimer selon ton besoin
             */

            $table->string('name')->nullable(); // ancien système
            $table->string('email')->nullable(); // ancien système
            $table->string('subject')->nullable(); // ancien système
            $table->text('message')->nullable(); // ancien système


            /**
             * ====== MÉTADONNÉES ======
             */

            $table->boolean('is_read')->default(false);    // message lu ?
            $table->timestamps();


            /**
             * ====== CLÉS ÉTRANGÈRES ======
             */
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
