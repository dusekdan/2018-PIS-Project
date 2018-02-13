<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationBookable extends Model
{
    protected $fillable = ['reservation_id', 'bookable_id'];

    protected $table = 'reservation_bookables';


    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function bookable()
    {
        return $this->belongsTo(Bookable::class);
    }

}
