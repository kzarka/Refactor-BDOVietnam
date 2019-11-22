<?php

namespace App\Services\Post;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Services\Contracts\PostServiceInterface;
use Illuminate\Support\Collection;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Models\Category;

class PostService implements PostServiceInterface
{
	protected $postRepos;

	public function __construct(PostRepositoryInterface $postRepos) {
		$this->postRepos = $postRepos;
	}

	public function getPostList($perPage = 10) {
		return $this->postRepos->getPostList($perPage);
	}
}