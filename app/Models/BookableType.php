<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookableType extends Model
{
    protected $fillable = ['name'];

    public function bookables() {
        return $this->hasMany(Bookable::class);
    }
}
