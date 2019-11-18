<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
	public function getCreatedAtAttribute($value) {
	    return \Carbon\Carbon::parse($value)->format('d-m-Y');
	}

	public function getUpdateAtAttribute($value) {
	    return \Carbon\Carbon::parse($value)->format('d-m-Y');
	}
}