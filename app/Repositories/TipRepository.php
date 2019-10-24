<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\TipsRepositoryInterface;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Tip;

class TipRepository extends BaseRepository implements TipsRepositoryInterface
{
	public function model()
    {
        return Tip::class;
    }
}