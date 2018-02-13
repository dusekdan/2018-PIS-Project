<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    public function staff() {
        return $this->hasMany(Staff::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
