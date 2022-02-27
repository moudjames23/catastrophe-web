<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SousPrefecture extends Model
{

    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }

    public function alertes()
    {
        return $this->hasMany(Alerte::class);
    }

    public function scopeExclude($query,$value=[])
    {
        return $query->select( array_diff( $this->columns,(array) $value) );
    }
}
