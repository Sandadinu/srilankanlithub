<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Essay extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'book_id', 'contributor_id', 'writer_name', 'submission_id', 'is_published'];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }

    protected $with = ['book', 'contributor'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function contributor()
    {
        return $this->belongsTo(Contributor::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($essay) {
            if (empty($essay->slug)) {
                $essay->slug = static::generateUniqueSlug($essay->title);
            }
        });
    }

    public static function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $count++;
        }

        return $slug;
    }

    public function getExcerptAttribute()
    {
        return Str::limit(strip_tags($this->content), 150);
    }
}