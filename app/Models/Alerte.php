<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alerte extends Model
{
    protected $fillable = ['nom', 'url', 'image'];

    protected $searchableFields = ['*'];

    public function agent()
    {
        return $this->belongsTo('App\Models\Agent');
    }

    public function ville()
    {
        return $this->belongsTo('App\Models\Ville');
    }

    public function alea()
    {
        return $this->belongsTo('App\Models\Alea');
    }



    public function getMessageAttribute()
    {
        return $this->ville->nom. '; Aléa: ' .$this->alea->nom;
    }
}
