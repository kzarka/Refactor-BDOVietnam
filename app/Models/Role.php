<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
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