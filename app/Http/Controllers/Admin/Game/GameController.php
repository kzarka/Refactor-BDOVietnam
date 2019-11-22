<?php

namespace App\Http\Controllers\Admin\Game;

use App\Http\Controllers\BaseController;
use App\Services\Contracts\GameServiceInterface;
use App\Repositories\Contracts\GameRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\GameInputRequest;

class GameController extends BaseController
{
	protected $gameService, $gameRepos;

	public function __construct(GameServiceInterface $gameService, GameRepositoryInterface $gameRepos)
    {
        $this->gameService = $gameService;
        $this->gameRepos = $gameRepos;
    }

    public function index(Request $request)
    {
    	$games = $this->gameService->getGameListPagination(true);
        return view('admin.games.index', ['games' => $games]);
    }

    public function update(GameInputRequest $request, $id)
    {
        try {
            $result = $this->gameRepos->updateByAdmin($request->all(), $id);
            return $this->respondWithSuccess($result);
        } catch (Exception $e) {
            return $this->respondWithError([], $e->getMessage());
        }
    }

    public function store(GameInputRequest $request)
    {
        try {
            $result = $this->gameRepos->create($request->all());
            return $this->respondWithSuccess($result);
        } catch (Exception $e) {
            return $this->respondWithError([], $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $result = $this->gameRepos->deleteByAdmin($id);
        if($result) {
            $this->saveSessionSuccessMessage('Item deleted successfully.');
        } else {
            $this->saveSessionSuccessMessage('Item cannot be deleted.');
        }
        return redirect()->route('admin.games.index');
    }

    public function load(Request $request) {
        $games = $this->gameService->getGameListPagination(true);
        return $this->respondWithSuccess($games);
    }
}
