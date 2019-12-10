<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use App\Models\Role;
use App\Models\Media\ShouldMedia;
use App\Models\Media\MediaModelTrait;
use Carbon\Carbon;

class User extends Authenticatable implements ShouldMedia
{
    use Notifiable, MediaModelTrait;

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

    public static $mediaConfigs = [
        'table' => 'user_images',
        'path_prefix' => 'users/images',
        'owner_key' => 'id',
        'foreign_key' => 'user_id',
        'fall_back' => '/assets/images/user/default.png',
        'conversions' => [
            USER_AVATAR_COLLECTION => ['thumbnail', 'small_thumbnail']
        ]
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

    public function getLastLoginFromAttribute($value) 
    {
        return Carbon::parse($this->last_login)->diffForHumans();
    }

    /**
     * @return mixed|null
     */
    public function getMediaUrl()
    {
        $dishMediaUrl = $this->getFirstMediaUrl(USER_AVATAR_COLLECTION);
        $dishMediaThumbUrl = $this->getFirstMediaUrl(USER_AVATAR_COLLECTION);
        $dishMediaThumbSmallUrl = $this->getFirstMediaUrl(USER_AVATAR_COLLECTION);
        if ($dishMediaUrl || $dishMediaThumbUrl || $dishMediaThumbSmallUrl) {
            return [
                'collection' => USER_AVATAR_COLLECTION,
                'default' => $dishMediaUrl,
                'thumb' => $dishMediaThumbUrl,
                'thumb_small' => $dishMediaThumbSmallUrl,
            ];
        }
        return $this->dishMediaService->getDishMediaUrl($dish);
    }

    public function getUserAvatarSmallThumbnail()
    {
        return $this->getFirstMediaUrl(USER_AVATAR_COLLECTION, MEDIA_CONVERSION_THUMB_SMALL);
    }

    public function getUrlAttribute()
    {
        return url('') . '/' . DEFAULT_AUTHOR_URL_PREFIX . '/' . $this->username . '.html';
    }
}
