<?php

namespace App\Models;

use App\Models\BaseModel;

class Class extends BaseModel
{
	protected $table = "classes";

    protected $fillable = [
        'name'
    ];
}