<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\GamesRepositoryInterface;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Game;

class GameRepository extends BaseRepository implements GamesRepositoryInterface
{
	public function model()
    {
        return Game::class;
    }
}