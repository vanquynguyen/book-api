<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'booking_id', 
        'full_name', 
        'phone',
        'gender',
        'address',
        'country'
    ];

    public function booking()
    {
        return $this->hasMany(Book::class, 'booking_id');
    }
}
