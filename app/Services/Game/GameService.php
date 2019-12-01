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

	public function getListPagination($all = false, $perPage = 10) {
		return $this->gameRepos->getListPagination($all, $perPage);
	}

	public function getList($all = false) {
		return $this->gameRepos->getList($all);
	}
}