<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use Searchable;

    protected $searchableFields = ['*'];
}
