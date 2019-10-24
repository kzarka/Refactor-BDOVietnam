<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\CategoriesRepositoryInterface;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Category;

class CategoryRepository extends BaseRepository implements CategoriesRepositoryInterface
{
	public function model()
    {
        return Category::class;
    }
}