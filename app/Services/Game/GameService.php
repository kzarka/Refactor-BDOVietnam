<?php

namespace App\Services\Game;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Services\Contracts\GameServiceInterface;
use Illuminate\Support\Collection;
use App\Repositories\Contracts\GameRepositoryInterface;
use App\Models\Category;

class GameService implements GameServiceInterface
{
	protected $gameRepos;

	public function __construct(GameRepositoryInterface $gameRepos) {
		$this->gameRepos = $gameRepos;
	}

	public function getGameListPagination($all = false, $perPage = 10) {
		return $this->gameRepos->getGameListPagination($all, $perPage);
	}

	public function getGameList($all = false) {
		return $this->gameRepos->getGameList($all);
	}
}