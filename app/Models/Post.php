<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $table = "posts";

    protected $fillable = [
        'user_id', 'restaurant_id', 'dish_id', 'quantity'
    ];
}