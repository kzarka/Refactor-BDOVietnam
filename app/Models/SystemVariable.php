<?php

namespace App\Models;

use App\Models\BaseModel;

class SystemVariable extends BaseModel
{
	protected $table = "system_variables";

    protected $fillable = [
        'name', 'value'
    ];
}