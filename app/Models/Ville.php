<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use Searchable;

    protected $fillable = ['nom'];

    protected $searchableFields = ['*'];

    public function catastrophes()
    {
        return $this->hasMany(Catastrophe::class);
    }

    public function alertes()
    {
        return $this->hasMany(Alerte::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function sousPrefectures()
    {
        return $this->hasMany(SousPrefecture::class);
    }

}
