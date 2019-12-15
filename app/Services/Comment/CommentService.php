<?php

namespace App\Services\Comment;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Services\Contracts\CommentServiceInterface;
use Illuminate\Support\Collection;
use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Models\Category;

class CommentService implements CommentServiceInterface
{
	protected $commentRepos;

	public function __construct(CommentRepositoryInterface $commentRepos) {
		$this->commentRepos = $commentRepos;
	}

	public function getListPagination($perPage = 10) {
		if(auth()->user()->authorizeRoles([ROLE_ADMIN, ROLE_MOD])) {
			return $this->commentRepos->getListPagination(null, $perPage);
		}
		return $this->commentRepos->getListPagination(auth()->user()->id, $perPage);
	}

	public function getList($public = true, $approved = true) {
		return $this->commentRepos->getList($public, $approved);
	}

	public function getNewestPost($catId = null, $perPage = 10)
	{
		return $this->commentRepos->getNewestPost($catId, $perPage);
	}

	public function getTopPost($catId = null, $perPage = 10)
	{
		return $this->commentRepos->getTopPost($catId, $perPage);
	}

	public function getCommentsByPost($postId) {
		return $this->commentRepos->getCommentsByPost($postId);
	}
}