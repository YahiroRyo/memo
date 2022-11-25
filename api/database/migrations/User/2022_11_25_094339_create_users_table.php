<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private string $tableName = 'users';

    public function up(): void {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id('userId');

            $table->string('email', 255);
            $table->string('password', 255);
            $table->rememberToken();
            $table->timestamp('createdAt')->useCurrent();
        });
    }

    public function down(): void {
        Schema::dropIfExists($this->tableName);
    }
};
