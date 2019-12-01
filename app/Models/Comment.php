<?php

namespace App\Models;

use App\Models\BaseModel;

class Comment extends BaseModel
{
	protected $table = "comments";

    protected $fillable = [
        'comment', 'name', 'author_id', 'website', 'parent_id', 'email', 'post_id'
    ];

    public function children()
    {
        return $this->hasMany('App\Models\Comment', 'parent_id');
    }

    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id');
    }

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }
}