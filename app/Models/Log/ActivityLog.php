<?php

namespace App\Models\Log;

use App\Models\BaseModel;

class ActivityLog extends BaseModel
{
	protected $table = "activity_logs";

    protected $fillable = [
        'user_id', 'action', 'entity_type', 'entity_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function entity()
    {
        return $this->morphTo();
    }
}