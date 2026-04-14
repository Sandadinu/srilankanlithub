<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['name', 'bio', 'image'];

    public function books()
    {
        return $this->hasMany(Book::class)->latest();
    }

    public function getImageUrlAttribute()
    {
        return $this->image 
            ? asset('uploads/' . $this->image) 
            : asset('images/default-author.jpg');
    }
}