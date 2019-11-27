<?php

namespace App\Services\Category;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Services\Contracts\CategoryServiceInterface;
use Illuminate\Support\Collection;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryService implements CategoryServiceInterface
{
	protected $catRepos;

	public function __construct(CategoryRepositoryInterface $catRepos) {
		$this->catRepos = $catRepos;
	}

	public function getCategoryListPagination($all = false, $exceptId = null, $perPage = 10) {
		return $this->catRepos->getCategoryListPagination($all, $perPage);
	}

	public function getCategoryList($all = false, $exceptId = null) {
		return $this->catRepos->getCategoryList($all, $exceptId);
	}
}