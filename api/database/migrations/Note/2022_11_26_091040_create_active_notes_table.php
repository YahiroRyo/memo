<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    private string $tableName = 'active_notes';

    public function up(): void
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->char('note_id', 26)->primary();

            $table->foreignId('user_id');
            $table->text('body');
            $table->text('title');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('note_id')->references('note_id')->on('notes');
            $table->foreign('user_id')->references('user_id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::drop($this->tableName);
    }
};
