<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Services\Contracts\GamesServiceInterface;
use Illuminate\Support\Collection;
use App\Repositories\Contracts\GamesRepositoryInterface;
use App\Models\Category;

class GamesService implements GamesServiceInterface
{
	protected $gameRepos;

	public function __construct(GamesRepositoryInterface $gameRepos) {
		$this->gameRepos = $gameRepos;
	}

	public function getGameList($perPage = 10) {
		return $this->gameRepos->getGameList($perPage);
	}
}