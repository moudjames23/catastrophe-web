<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;

class Catastrophe extends Model
{
    use Searchable;

    protected $fillable = ['valeur', 'url', 'alea_id', 'ville_id'];

    protected $searchableFields = ['*'];

    public function alea()
    {
        return $this->belongsTo(Alea::class);
    }

    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }
}
