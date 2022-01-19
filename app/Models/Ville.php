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
}
