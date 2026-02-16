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
        Schema::table('messages', function (Blueprint $table) {
             // Champs système de messagerie interne
        if (!Schema::hasColumn('messages', 'sender_id')) {
            $table->unsignedBigInteger('sender_id')->nullable()->after('id');
        }

        if (!Schema::hasColumn('messages', 'receiver_id')) {
            $table->unsignedBigInteger('receiver_id')->nullable()->after('sender_id');
        }

        if (!Schema::hasColumn('messages', 'body')) {
            $table->text('body')->nullable()->after('message');
        }

        if (!Schema::hasColumn('messages', 'is_read')) {
            $table->boolean('is_read')->default(false)->after('body');
        }

        if (!Schema::hasColumn('messages', 'parent_id')) {
            $table->unsignedBigInteger('parent_id')->nullable()->after('is_read');
        }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            //
        });
    }
};
