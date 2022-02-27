<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public function villes()
    {
        return $this->hasMany(Ville::class);
    }
}
