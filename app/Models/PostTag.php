<?php

namespace App\Models;

use App\Models\BaseModel;

class PostTag extends BaseModel
{
	protected $table = "posts_tags";

    protected $fillable = [
        'post_id', 'tag_id'
    ];
}