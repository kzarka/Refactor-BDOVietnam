<?php

namespace App\Models;

use App\Models\BaseModel;

class Game extends BaseModel
{
	protected $table = "games";

    protected $fillable = [
        'name', 'thumbnail', 'active', 'slug'
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