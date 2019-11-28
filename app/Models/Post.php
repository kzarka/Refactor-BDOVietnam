<?php

namespace App\Models;

use App\Models\BaseModel;

class Post extends BaseModel
{
	protected $table = "posts";

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

    public function author() {
        return $this->belongsTo('App\User')->withDefault([
            'name' => 'Guest'
        ]);
    }

    public function categories() {
        return $this->hasMany('App\Model\Category');
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
}