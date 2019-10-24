<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\PostsRepositoryInterface;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Post;

class PostRepository extends BaseRepository implements PostsRepositoryInterface
{
	public function model()
    {
        return Post::class;
    }

    public function getPostsBuilder($catId = null, $userId = null) {
    	$builder = $this->model->select(
    		'posts.id',
    		'posts.title',
    		'posts.excert',
    		'users.name as author_name'
    		'categories.id as cat_id',
    		'categories.name as cat_name'
    	)
    	->join('users', 'users.id', '=', 'posts.author_id')
    	->join('posts_categories as post_cat', function($join) use ($catId) {
			$join->on('post_cat.post_id', '=', 'posts.id');
    	})
    	->join('categories', function($join) use ($catId) {
    		$join->whereRaw('categories.id', '=', 'posts_categories.cat_id');
    	});

    	if(isset($catId)) {
    		$builder->whereRaw('categories.id = ' . $catId);
    	}
    	if(isset($userId)) {
    		$builder->whereRaw('posts.author_id = ' . $userId);
    	}

    	return $builder;
    }
}