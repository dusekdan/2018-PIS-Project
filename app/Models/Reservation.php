<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['reservationDate','reservationStartTime',
        'reservationEndTime',
        'numberOfPeople', 'reservation_key',
        'note', 'customerName', 'customerEmail'];

    public function reservation_bookables() {
        return $this->hasMany(ReservationBookable::class);
    }
}
