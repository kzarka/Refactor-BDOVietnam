<?php

namespace App\Models;

use App\Models\BaseModel;
use App\User;

class Role extends BaseModel
{
	protected $table = "roles";

    protected $fillable = [
        'name'
    ];

    public static function findByName($name)
    {
    	return self::where('name', $name)->firstOrFail();
    }

    public function users()
	{
	  return $this->belongsToMany(User::class);
	}
}