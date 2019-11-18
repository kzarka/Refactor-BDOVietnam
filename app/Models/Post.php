<?php

namespace App\Models;

use App\Models\BaseModel;

class Post extends BaseModel
{
	protected $table = "posts";

    protected $fillable = [
        'user_id', 'restaurant_id', 'dish_id', 'quantity'
    ];
}