<?php

namespace App\Models;

use App\Models\BaseModel;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Post extends BaseModel implements HasMedia
{
    use HasMediaTrait;

	protected $table = "posts";

    public static $mediaConfigs = [
        'table' => 'review_imgs',
        'path_prefix' => 'reviews/images',
        'owner_key' => 'id',
        'foreign_key' => 'review_id',
        'conversions' => [
            'MEDIA_REVIEW_COLLECTION_DEFAULT' => [
                'MEDIA_REVIEW_COLLECTION_THUMB' => [
                    'width' => 500,
                ],
                'MEDIA_REVIEW_COLLECTION_THUMB_SMALL' => [
                    'width' => 200,
                ],
            ]
        ]
    ];

    protected $fillable = [
        'title', 'content', 'slug', 'excert', 'author_id', 'thumbnail', 'banner', 'public', 'approved'
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

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion(THUMB_CONVERSION)
              ->width(150)
              ->height(150)
              ->sharpen(10)
              ->performOnCollections('images', 'downloads');
    }

    public function author() {
        return $this->belongsTo('App\Models\User', 'author_id')->withDefault([
            'name' => 'Guest'
        ]);
    }

    public function categories() {
        return $this->belongsToMany('App\Models\Category', 'posts_categories', 'post_id', 'cat_id');
    }

    public function comments() {
        return $this->hasMany('App\Models\Comment', 'post_id');
    }

    public function canModify() {
        $user = auth()->user();
        if($user->authorizeRoles([ROLE_ADMIN])) return true;
        $author = $this->author;
        if($author->haveRole(ROLE_ADMIN)) return false;
        if($author->haveRole(ROLE_MOD) && $author->id !== $user->id) return false;
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
        if($author->haveRole(ROLE_ADMIN)) return false;
        if($author->haveRole(ROLE_MOD) && $author->id !== $user->id) return false;
        if($this->author_id == $user->id) return true;
        return false;
    }

    public static function getNumberUnapprovedPost() {
        return \DB::table('posts')
            ->where('approved', STATUS_UNAPPROVED)
            ->get()->count();
    }

    public function getUrlAttribute($value) {

        $category = $this->categories()->first();
        return url('') . '/' . DEFAULT_URL_PREFIX . '/' . ($category ? $category->slug : DEFAULT_CATEGORY) . '/' . $this->slug . '.html';
    }
    
    /**
     * get dish media url by review and dish
     * @param Review $review
     * @return mixed|null
     */
    public function getDishMediaUrl()
    {
        $dishMediaUrl = $this->getFirstMediaUrl('MEDIA_REVIEW_COLLECTION_DEFAULT');
        $dishMediaThumbUrl = $this->getFirstMediaUrl('MEDIA_REVIEW_COLLECTION_THUMB');
        $dishMediaThumbSmallUrl = $this->getFirstMediaUrl('MEDIA_REVIEW_COLLECTION_THUMB_SMALL');
        if ($dishMediaUrl || $dishMediaThumbUrl || $dishMediaThumbSmallUrl) {
            return [
                'collection' => 'MEDIA_DISH_COLLECTION_REVIEW',
                'default' => $dishMediaUrl,
                'thumb' => $dishMediaThumbUrl,
                'thumb_small' => $dishMediaThumbSmallUrl,
            ];
        }
        return $this->dishMediaService->getDishMediaUrl($dish);
    }
}