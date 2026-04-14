<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = ['name', 'email', 'title', 'book_id', 'content', 'short_bio', 'status'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function essay()
    {
        return $this->hasOne(Essay::class);
    }
}
