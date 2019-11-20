<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\TagRepositoryInterface;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Tag;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
	public function model()
    {
        return Tag::class;
    }
}