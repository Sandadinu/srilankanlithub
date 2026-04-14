<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Contributor;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Contributor::whereNull('slug')->chunk(100, function ($contributors) {
            foreach ($contributors as $contributor) {
                $contributor->slug = Contributor::generateUniqueSlug($contributor->name);
                $contributor->save();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not easily reversible
    }
};
