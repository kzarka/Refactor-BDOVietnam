<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = "tags";

    protected $fillable = [
        'id', 'name', 'slug'
    ];

    public function getUrlAttribute($value) {
        return url('') . '/' . DEFAULT_TAG_URL_PREFIX . '/' . $this->slug . '/';
    }

    public function posts() {
        return $this->belongsToMany('App\Models\Post', 'posts_tags', 'tag_id', 'post_id');
    }
}