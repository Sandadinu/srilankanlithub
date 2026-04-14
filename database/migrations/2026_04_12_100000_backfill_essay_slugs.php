<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Essay;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Use a chunked approach to be safe with many records
        Essay::whereNull('slug')->chunk(100, function ($essays) {
            foreach ($essays as $essay) {
                // The generateUniqueSlug logic is already in the Model
                $essay->slug = Essay::generateUniqueSlug($essay->title);
                $essay->save();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No easy way to reverse this without losing intent, but we can null them out if we really wanted to
        // However, it's safer to leave them as they are unique.
    }
};
