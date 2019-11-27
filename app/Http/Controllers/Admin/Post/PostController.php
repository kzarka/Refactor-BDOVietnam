<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\BaseController;
use App\Services\Contracts\PostServiceInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PostInputRequest;
use App\Services\Contracts\GameServiceInterface;
use App\Services\Contracts\CategoryServiceInterface;

class PostController extends BaseController
{
	protected $postService, $postRepos, $gameService, $catService;

	public function __construct(PostServiceInterface $postService, PostRepositoryInterface $postRepos, GameServiceInterface $gameService, CategoryServiceInterface $catService)
    {
        $this->postService = $postService;
        $this->postRepos = $postRepos;
        $this->gameService = $gameService;
        $this->catService = $catService;
    }

    public function index(Request $request)
    {
    	$records = $this->postService->getPostList();
        return view('admin.post.index', ['posts' => $records]);
    }

    public function create(Request $request) {
        $games = $this->gameService->getGameList();
        $categories = $this->catService->getCategoryList();
        return view('admin.post.create', ['games' => $games, 'categories' => $categories]);
    }

    public function edit(Request $request, $id) {
        $post = $this->postRepos->find($id);
        if(!$post) {
            $this->saveSessionErrorMessage('Post not found!');
            return view('admin.post.edit', ['games' => $games]);
        }
        return view('admin.post.edit');
    }

    public function update(PostInputRequest $request, $id)
    {
        try {
            $result = $this->postRepos->updateByAdmin($request->all(), $id);
            return $this->respondWithSuccess($result);
        } catch (Exception $e) {
            return $this->respondWithError([], $e->getMessage());
        }
    }

    public function store(PostInputRequest $request)
    {
        \Log::info($request->all());
        try {
            $result = $this->postRepos->create($request->all());
            return redirect()->route('admin.post.index');
        } catch (Exception $e) {
            $this->saveSessionErrorMessage($e->getMessage());
            return redirect()->route('admin.post.create');
        }
    }

    public function destroy($id)
    {
        $result = $this->postRepos->deleteByAdmin($id);
        if($result) {
            $this->saveSessionSuccessMessage('Item deleted successfully.');
        } else {
            $this->saveSessionSuccessMessage('Item cannot be deleted.');
        }
        return redirect()->route('admin.category.index');
    }

    public function load(Request $request) {
        return $this->postService->getPostList();
    }
}
