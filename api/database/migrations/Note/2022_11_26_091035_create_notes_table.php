<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    private string $tableName = 'notes';

    public function up(): void
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->char('note_id', 26)->primary();

            $table->timestamp('createdAt')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::drop($this->tableName);
    }
};
