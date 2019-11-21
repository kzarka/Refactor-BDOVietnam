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

	public function getCategoryList($perPage = 10) {
		return $this->catRepos->getCategoryList($perPage);
	}

	public function loadCategorySelect($exceptId) {
		return $this->catRepos->loadCategorySelect($exceptId);
	}
}