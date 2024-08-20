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
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();

            // Добавляем колонку для связи с таблицей пользователей
            $table->foreignId('user_id')
                ->constrained('users');  // Указываем таблицу, с которой связана колонка

            $table->foreignId('event_type_id')
                ->constrained('event_types');

            // Для получения ответов
            $table->string('telegram_username')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('email')->nullable();

            $table->string('slug')->unique();
            $table->string('title');
            $table->json('content');
            $table->date('date');
            $table->json('location');
            $table->boolean('is_published')->default(false);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
