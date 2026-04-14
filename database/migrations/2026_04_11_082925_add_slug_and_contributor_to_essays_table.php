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
        Schema::table('essays', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('title');
            $table->foreignId('contributor_id')->nullable()->after('book_id')->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('essays', function (Blueprint $table) {
            $table->dropForeign(['contributor_id']);
            $table->dropColumn(['slug', 'contributor_id']);
        });
    }
};
