<?php

namespace App\Models;

use App\Models\BaseModel;

class PostTag extends BaseModel
{
	protected $table = "posts_tags";

    protected $fillable = [
        'name'
    ];
}