<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;

class Alerte extends Model
{
    use Searchable;

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

    public function getTauxAttribute()
    {
        if ($this->mort != 0 || $this->personnes != null)
            return number_format((($this->mort * 100) / $this->personnes), 2);

        return 0;
    }


    public function getMessageAttribute()
    {
        return $this->ville->nom . '; Aléa: ' . $this->alea->nom . ' Personnes: ' . $this->personnes . ' Décédés: ' . $this->mort;
    }
}
