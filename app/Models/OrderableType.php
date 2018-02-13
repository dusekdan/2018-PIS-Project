<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderableType extends Model
{
    protected $fillable = ['name'];

    public function orderables()
    {
        return $this->hasMany(Orderable::class);
    }
}
