<?php

namespace App\Http\Controllers\Admin\Games;

use App\Http\Controllers\Controller;
use App\Services\Contracts\GamesServiceInterface;
use App\Repositories\Contracts\GamesRepositoryInterface;
use Illuminate\Http\Request;

class GamesController extends Controller
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

    public function create(Request $request)
    {
        return view('admin.games.create');
    }

    public function edit(Request $request)
    {
        $game = $this->gameRepos->find($request->get('id'));
        return view('admin.games.edit', ['game' => $game]);
    }
}
