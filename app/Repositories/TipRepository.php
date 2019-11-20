<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\TipRepositoryInterface;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Tip;

class TipRepository extends BaseRepository implements TipRepositoryInterface
{
	public function model()
    {
        return Tip::class;
    }
}