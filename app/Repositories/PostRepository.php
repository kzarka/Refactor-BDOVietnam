<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Post;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
	public function model()
    {
        return Post::class;
    }

    public function postsBuilder($catId = null, $userId = null) {
    	$builder = $this->model->select(
            'posts.*',
    		'users.username as author_name'
    	)
    	->leftJoin('users', 'users.id', '=', 'posts.author_id');
    	
    	if(isset($catId)) {
    		$builder->join('posts_categories as post_cat', function($join) {
                $join->on('post_cat.post_id', '=', 'posts.id');
            })
            ->join('categories', function($join) {
                $join->where('categories.id', '=', 'posts_categories.cat_id');
            })
            ->whereRaw('categories.id = ' . $catId);
    	}
    	if(isset($userId)) {
    		$builder->whereRaw('posts.author_id = ' . $userId);
    	}

    	return $builder;
    }

    public function publicApproveFiler($builder, $public = true, $approved = true) {
        if($public) {
            $builder->public();
        }
        if($approved) {
            $builder->approved();
        } else {
            $builder->where('approved', STATUS_UNAPPROVED);
        }
        return $builder;
    }

    public function getPostListPagination($public = true, $approved = true,  $perPage = 10) {
        $builder = $this->postsBuilder();
        $builder = $this->publicApproveFiler($builder, $public, $approved);
        return $builder->paginate($perPage);
    }

    public function getPostList($public = true, $approved = true) {
        $builder = $this->postsBuilder();
        $builder = $this->publicApproveFiler($builder, $public, $approved);
        return $builder->get();
    }

    public function createByAdmin($data) {
        $user = auth()->user();
        $data['author_id'] = $user->id;
        if($user->authorizeRoles([ROLE_ADMIN, ROLE_MOD])) {
            $data['approved'] = STATUS_APPROVED;
        } else {
            $data['approved'] = STATUS_UNAPPROVED;
        }

        $record = $this->model->create($data);
        return $record;
    }

    public function updateByAdmin($data, $id) {
        \DB::beginTransaction();
        try {
            $record = $this->model->findOrFail($id);
            if(!$record->canModify()) return false;
            
            $user = auth()->user();
            if(auth()->user()->authorizeRoles([ROLE_CTV])) {
                $data['approved'] = STATUS_UNAPPROVED;
            }
            $record->update($data);
            \DB::commit();
            return $record;
        } catch (\Exception $e) {
            \DB::rollback();
            throw new \Exception($e->getMessage());
            return false;
        }
    }

    public function deleteByAdmin($id) {
        \DB::beginTransaction();
        try {
            $record = $this->model->findOrFail($id);
            if(!$record->canDelete()) return false;
            $record->delete();
            \DB::commit();
            return $record;
        } catch (\Exception $e) {
            \DB::rollback();
            return false;
        }
    }

    public function approveByAdmin($id) {
        \DB::beginTransaction();
        try {
            $record = $this->model->findOrFail($id);
            if(!$record->canApprove()) return false;
            $record->update(['approved' => STATUS_APPROVED]);
            \Log::info($record);
            \DB::commit();
            return $record;
        } catch (\Exception $e) {
            \DB::rollback();
            return false;
        }
    }
}