<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\CommentsRepositoryInterface;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Comment;

class CommentRepository extends BaseRepository implements CommentsRepositoryInterface
{
	public function model()
    {
        return Comment::class;
    }
}