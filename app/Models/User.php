<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use App\Models\Role;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Carbon\Carbon;

class User extends Authenticatable implements HasMedia
{
    use Notifiable, HasMediaTrait;

    public function scopeActive($query)
    {
        return $query->where('active', STATUS_ACTIVE);
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'username', 'email', 'password', 'status', 'biography', 'active', 'banned_until', 'last_login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'banned_until'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
      return $this->belongsToMany(Role::class);
    }
    
    /**
     * @param string|array $roles
     */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles);
        }
        return $this->hasRole($roles);
    }
    /**
    * Check multiple roles
    * @param array $roles
    */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }
    /**
    * Check one role
    * @param string $role
    */
    public function hasRole($role)
    {
        if($role instanceof Collection) {
            $role = $role->name;
        }
        return null !== $this->roles()->where('name', $role)->first();
    }

    public function posts() {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'author_id');
    }

    public function getCreatedAtAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    public function getUpdateAtAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    public function canDelete() {
        if(!auth()->user()->authorizeRoles('ROLE_ADMIN')) return false;
        if($this->authorizeRoles('ROLE_ADMIN')) return false;
        return true;
    }

    public function getFullnameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion(THUMB_CONVERSION)
              ->width(THUMBNAIL_WIDTH)
              ->height(THUMBNAIL_HEIGHT)
              ->sharpen(10)
              ->performOnCollections(USER_MEDIA_COLLECTION);
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection(USER_MEDIA_COLLECTION)
            ->useFallbackUrl('/assets/images/default_user.png')
            ->useFallbackPath(public_path('/assets/images/default_user.png'));
    }

    public function getLastLoginFromAttribute($value) 
    {
        return Carbon::parse($this->last_login)->diffForHumans();
    }
}
