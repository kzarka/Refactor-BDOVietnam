<?php

namespace App\Models;

use App\Models\BaseModel;

class Post extends BaseModel
{
	protected $table = "posts";

    protected $fillable = [
        'user_id', 'restaurant_id', 'dish_id', 'quantity'
    ];

    /**
     * Scope a query to only include active item.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublic($query)
    {
        return $query->where('public', STATUS_ACTIVE);
    }
}