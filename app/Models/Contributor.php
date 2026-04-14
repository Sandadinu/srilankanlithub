<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Contributor extends Model
{
    protected $fillable = ['name', 'slug', 'email', 'bio'];

    public function essays()
    {
        return $this->hasMany(Essay::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($contributor) {
            if (empty($contributor->slug)) {
                $contributor->slug = static::generateUniqueSlug($contributor->name);
            }
        });
    }

    public static function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $original = $slug;
        $count = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $count++;
        }

        return $slug;
    }
}
