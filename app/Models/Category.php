<?php

namespace App\Models;

use App\Models\BaseModel;

class Category extends BaseModel
{
	protected $table = "categories";

    protected $fillable = [
        'name', 'slug', 'banner', 'active', 'parent_id', 'description'
    ];

    /**
     * Scope a query to only include active item.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', STATUS_ACTIVE);
    }

    public function children()
    {
        return $this->hasMany('App\Models\Category', 'parent_id');
    }

    public function posts() {
        return $this->belongsToMany('App\Models\Post', 'posts_categories', 'post_id', 'cat_id');
    }

    public function getUrlAttribute($value) {

        return url('') . '/' . CATEGORY_PATH . '/' . $this->slug . '.html';
    }
}