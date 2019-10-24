<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\ClassesRepositoryInterface;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Class;

class ClassRepository extends BaseRepository implements ClassesRepositoryInterface
{
	public function model()
    {
        return Class::class;
    }
}