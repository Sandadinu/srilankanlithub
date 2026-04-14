<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author_id',
        'published_year',
        'genre',
        'short_description',
        'description',
        'image',
        'amazon_link',
        'goodreads_link'
    ];

    protected $with = ['author'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function essays()
    {
        return $this->hasMany(Essay::class)->latest();
    }

    public function awards()
    {
        return $this->hasMany(Award::class);
    }

    public function getImageUrlAttribute()
    {
    return $this->image 
        ? asset('img/' . $this->image) 
        : asset('img/default-book.jpg');     }

}