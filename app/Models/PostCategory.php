<?php

namespace App\Models;

use App\Models\BaseModel;

class PostCategory extends BaseModel
{
	protected $table = "posts_categories";

    protected $fillable = [
        'name'
    ];
}