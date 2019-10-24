<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
	protected $table = "posts_comments";

    protected $fillable = [
        'name'
    ];
}