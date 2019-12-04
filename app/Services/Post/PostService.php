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

	public function getListPagination($public = WITH_PUBLIC_POST, $approved = ONLY_APPROVED_POST, $userId = null, $catId = null, $perPage = 10) {
		return $this->postRepos->getListPagination($public, $approved, $userId, $catId, $perPage);
	}

	public function getList($public = true, $approved = true) {
		return $this->postRepos->getList($public, $approved);
	}

	public function getNewestPost($catId = null, $perPage = 10)
	{
		return $this->postRepos->getNewestPost($catId, $perPage);	}

	public function getTopPost($catId = null, $perPage = 10)
	{
		return $this->postRepos->getTopPost($catId, $perPage);
	}

	public function getRelatePost($postId, $catId)
	{
		return $this->postRepos->getRelatePost($postId, $catId);
	}

	public function findGetImages($id)
	{
		$record = $this->postRepos->findBySlugOrId($id);
		if($record) {
			$record->banner_image = $record->getFirstMediaUrl(POST_BANNER_COLLECTION);
        	$record->thumbnail = $record->getFirstThumbnailUrl(POST_BANNER_COLLECTION);
		}
        return $record;
	}
}