<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderOrderableItem extends Model
{
    protected $fillable = ['orderable_id', 'order_id', 'status'];
    protected $table = "order_orderable";

    public function order()
    {
        return $this->belongsTo(Order::class)->withTimestamps();
    }

    public function orderable()
    {
        return $this->belongsTo(Orderable::class);
    }
}
