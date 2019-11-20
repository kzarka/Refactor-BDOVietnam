<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\ClassRepositoryInterface;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Class;

class ClassRepository extends BaseRepository implements ClassRepositoryInterface
{
	public function model()
    {
        return Class::class;
    }
}