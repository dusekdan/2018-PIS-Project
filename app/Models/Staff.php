<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = ['name', 'telephone'];

    public function role() {
        return $this->belongsTo(Role::class);
    }
}
