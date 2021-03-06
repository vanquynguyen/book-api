<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'image',
        'description',
        'author',
        'price',
        'sale',
        'amount',
        'status',
        'rate_average',
        'rate_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'book_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'book_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'book_id');
    }

    public function medias()
    {
        return $this->hasMany(Media::class, 'book_id');
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'book_id');
    }
}
