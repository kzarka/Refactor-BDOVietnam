<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BaseModel extends Model
{
	public function getCreatedAtTextAttribute($value) {
        return Carbon::parse($this->created_at)->locale(app()->getLocale())->translatedFormat('d M, Y');;
    }

    public function getCreatedAtTextFullAttribute($value) {
        return Carbon::parse($this->created_at)->locale(app()->getLocale())->translatedFormat('G:i A, d F Y');;
    }

    public function getCreatedAtTextFullShortMonthAttribute($value) {
        return Carbon::parse($this->created_at)->locale(app()->getLocale())->translatedFormat('G:i A, d M Y');;
    }

    public function getCreatedFromAttribute($value) {

        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function getUpdateFromAttribute($value) {

        return Carbon::parse($this->updated_at)->diffForHumans();
    }
}