<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;

class Alea extends Model
{
    use Searchable;

    protected $fillable = ['nom', 'url', 'image'];

    protected $searchableFields = ['*'];

    public function catastrophes()
    {
        return $this->hasMany(Catastrophe::class);
    }
}
