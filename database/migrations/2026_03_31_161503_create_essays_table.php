<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('essays', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content');
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
            $table->string('writer_name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('essays');
    }
};
