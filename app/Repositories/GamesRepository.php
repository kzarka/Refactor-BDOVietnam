<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\GamesRepositoryInterface;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Game;

class GamesRepository extends BaseRepository implements GamesRepositoryInterface
{
	public function model()
    {
        return Game::class;
    }

    public function getGameList($perPage = 10) {
		return $this->model->select('*')->paginate($perPage);
	}
}