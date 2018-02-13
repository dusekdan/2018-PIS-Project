<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['price'];

    public function order_status() {
        return $this->belongsTo(OrderStatus::class);
    }

    public function bookable() {
        return $this->belongsTo(Bookable::class);
    }

    public function orderables()
    {
        return $this->belongsToMany(Orderable::class)->withTimestamps();
    }

    public function order_orderables()
    {
        return $this->hasMany(OrderOrderableItem::class);
    }
}
