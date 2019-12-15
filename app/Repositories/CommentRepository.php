<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\CommentRepositoryInterface;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Comment;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
	public function model()
    {
        return Comment::class;
    }

    public function getBuilder($postId = null, $parentOnly = false)
    {
    	$builder = $this->model->select('comments.*');
    	if($postId) {
    		$builder->where('post_id', $postId);
    	}
    	if($parentOnly) {
    		$builder->whereNull('parent_id');
    	}
    	return $builder;
    }

    public function create($data)
    {
    	try {
    		$this->model->create($data);
    		return true;
    	} catch(\Exception $e) {
    		\Log::info($e);
    		return false;
    	}
    }

    public function getListPagination($userId = null, $perPage = 10) {
        
        $builder = $this->getBuilder();
        if($userId) {
            $builder->join('posts', 'posts.id', '=', 'comments.post_id')
            ->where('posts.author_id', $userId);
        }

        return $builder->with('post', 'author')->paginate($perPage);
    }

    public function getCommentsByPost($postId)
    {
    	return $this->getBuilder($postId, 1)->with('children')->get();
    }
}