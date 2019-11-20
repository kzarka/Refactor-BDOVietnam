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

	public function updateByAdmin($data, $id) {
		\DB::beginTransaction();
		try {
		    $game = $this->model->findOrFail($id);
			$game->update($data);
		    \DB::commit();
		    return $game;
		} catch (\Exception $e) {
		    \DB::rollback();
		    throw new \Exception($e->getMessage());
		    return 'false';
		}
	}

	public function deleteByAdmin($id) {
		\DB::beginTransaction();
		try {
		    $game = $this->model->findOrFail($id);
			if($game) $game->delete();
		    \DB::commit();
		    return true;
		} catch (\Exception $e) {
		    \DB::rollback();
		    return false;
		}
	}
}