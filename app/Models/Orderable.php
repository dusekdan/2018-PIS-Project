<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orderable extends Model
{
    protected $fillable = ['price', 'quantity', 'name'];

    public function orderable_type()
    {
        return $this->belongsTo(OrderableType::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function order_orderables()
    {
        return $this->hasMany(OrderOrderableItem::class);
    }
}
