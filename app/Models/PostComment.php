<?php

namespace App\Models;

use App\Models\BaseModel;

class PostComment extends BaseModel
{
	protected $table = "posts_comments";

    protected $fillable = [
        'name'
    ];
}