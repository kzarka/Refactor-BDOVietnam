<?php

namespace App\Models;

use App\Models\BaseModel;

class Game extends BaseModel
{
	protected $table = "games";

    protected $fillable = [
        'name'
    ];
}