<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['validityStart', 'validityEnd', 'name'];

    public function soup()
    {
        return $this->belongsTo(Orderable::class);
    }

    public function meal_1()
    {
        return $this->belongsTo(Orderable::class);
    }

    public function meal_2()
    {
        return $this->belongsTo(Orderable::class);
    }

    public function meal_3()
    {
        return $this->belongsTo(Orderable::class);
    }
}
