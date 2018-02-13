<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookable extends Model
{
    protected $fillable = ['capacity'];

    public function bookableType() {
        return $this->belongsTo(BookableType::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function reservation_bookables() {
        return $this->hasMany(ReservationBookable::class);
    }
}
