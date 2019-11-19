<?php

namespace App\Http\Controllers\Admin\Games;

use App\Http\Controllers\BaseController;
use App\Services\Contracts\GamesServiceInterface;
use App\Repositories\Contracts\GamesRepositoryInterface;
use Illuminate\Http\Request;

class GamesController extends BaseController
{
	protected $gameService, $gameRepos;

	public function __construct(GamesServiceInterface $gameService, GamesRepositoryInterface $gameRepos)
    {
        $this->gameService = $gameService;
        $this->gameRepos = $gameRepos;
    }

    public function index(Request $request)
    {
    	$games = $this->gameService->getGameList();
        return view('admin.games.index', ['games' => $games]);
    }

    public function update(Request $request, $id)
    {
        try {
            $result = $this->gameRepos->update($request->all(), $id);
            return $this->respondWithSuccess($result);
        } catch (Exception $e) {
            return $this->respondWithError(null, $e->getMessage());
        }
    }

    public function edit(Request $request)
    {
        $game = $this->gameRepos->find($request->get('id'));
        return view('admin.games.edit', ['game' => $game]);
    }
}
