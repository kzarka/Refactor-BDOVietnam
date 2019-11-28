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

	public function getPostListPagination($public = true, $approved = true,  $perPage = 10) {
		return $this->postRepos->getPostListPagination($public, $approved,  $perPage);
	}

	public function getPostList($public = true, $approved = true) {
		return $this->postRepos->getPostList($public, $approved);
	}
}