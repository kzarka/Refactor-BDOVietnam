<?php

namespace App\Models;

use App\Models\BaseModel;

class Comment extends BaseModel
{
	protected $table = "comments";

    protected $fillable = [
        'content'
    ];
}