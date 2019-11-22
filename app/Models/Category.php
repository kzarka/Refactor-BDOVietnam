<?php

namespace App\Models;

use App\Models\BaseModel;

class Category extends BaseModel
{
	protected $table = "categories";

    protected $fillable = [
        'name', 'slug', 'banner', 'active', 'parent_id'
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
}