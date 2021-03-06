<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\GameRepositoryInterface;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Game;

class GameRepository extends BaseRepository implements GameRepositoryInterface
{
	public function model()
    {
        return Game::class;
    }

	public function gameBuilder($all = false) {
		$builder = $this->model->select('*');
    	if(!$all) {
    		$builder->active();
    	}
    	return $builder;
	}

    public function getListPagination($all = false, $perPage = 10) {
    	
		return $this->gameBuilder($all)->paginate($perPage);
	}

	public function getList($all = false) {
		return $this->gameBuilder($all)->get();
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