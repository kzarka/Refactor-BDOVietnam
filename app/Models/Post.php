<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Media\ShouldMedia;
use App\Models\Media\MediaModelTrait;

class Post extends BaseModel implements ShouldMedia
{
    use MediaModelTrait;

	protected $table = "posts";

    public static $mediaConfigs = [
        'table' => 'post_images',
        'path_prefix' => 'posts/images',
        'owner_key' => 'id',
        'foreign_key' => 'post_id',
        'conversions' => [
            POST_BANNER_COLLECTION => ['thumbnail', 'small_thumbnail'],
        ]
    ];

    protected $fillable = [
        'title', 'content', 'slug', 'excert', 'author_id', 'thumbnail', 'banner', 'public', 'approved', 'end_date'
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

    public function scopeApproved($query)
    {
        return $query->where('approved', STATUS_ACTIVE);
    }

    public function author() {
        return $this->belongsTo('App\Models\User', 'author_id')->withDefault([
            'name' => 'Guest'
        ]);
    }

    public function categories() {
        return $this->belongsToMany('App\Models\Category', 'posts_categories', 'post_id', 'cat_id');
    }

    public function tags() {
        return $this->belongsToMany('App\Models\Tag', 'posts_tags', 'post_id', 'tag_id');
    }

    public function comments() {
        return $this->hasMany('App\Models\Comment', 'post_id');
    }

    public function canModify() {
        $user = auth()->user();
        if($user->authorizeRoles([ROLE_ADMIN])) return true;
        $author = $this->author;
        if($author->hasRole(ROLE_ADMIN)) return false;
        if($author->hasRole(ROLE_MOD) && $author->id !== $user->id) return false;
        if($this->author_id == $user->id) return true;
        return false;
    }

    public function canDelete() {
        $user = auth()->user();
        if($user->authorizeRoles([ROLE_ADMIN])) return true;
        $author = $this->author;
        if($this->author_id == $user->id) return true;
        return false;
    }

    public function canApprove() {
        $user = auth()->user();
        if($user->authorizeRoles([ROLE_ADMIN])) return true;
        $author = $this->author;
        if($author->hasRole(ROLE_ADMIN)) return false;
        if($author->hasRole(ROLE_MOD) && $author->id !== $user->id) return false;
        if($user->hasRole(ROLE_MOD)) return true;
        if($this->author_id == $user->id) return true;
        return false;
    }

    public static function getNumberUnapprovedPost() {
        return \DB::table('posts')
            ->where('approved', STATUS_UNAPPROVED)
            ->get()->count();
    }

    public function getUrlAttribute($value) {
        $category = $this->categories()->skip(1)->first() ?? $this->categories()->first();
        return url('') . '/' . DEFAULT_POST_URL_PREFIX . '/' . ($category ? $category->slug : DEFAULT_CATEGORY) . '/' . $this->slug . '.html';
    }

    public function getMainCategoryNameAttribute($value) {
        $category = $this->categories()->skip(1)->first() ?? $this->categories()->first();
        return $category ? $category->name : null;
    }
    
    /**
     * @return mixed|null
     */
    public function getMediaUrl()
    {
        $originImageUrl = $this->getFirstMediaUrl(POST_BANNER_COLLECTION);
        $imageThumbUrl = $this->getFirstThumbnailUrl(POST_BANNER_COLLECTION);
        $imageThumbSmallUrl = $this->getFirstSmallThumbnailUrl(POST_BANNER_COLLECTION);
        if ($originImageUrl || $imageThumbUrl || $imageThumbSmallUrl) {
            return [
                'collection' => POST_BANNER_COLLECTION,
                'default' => $originImageUrl,
                'thumb' => $imageThumbUrl,
                'thumb_small' => $imageThumbSmallUrl,
            ];
        }
        return [];
    }

    public function getRemainDayAttribute() {
        if(!$this->end_date) return null;
        return Carbon::now()->diffInDays($this->end_date, false);
    }
}