<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'book_id',
        'image_name',
        'image'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
