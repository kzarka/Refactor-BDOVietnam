<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\BaseController;
use App\Services\Contracts\PostServiceInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PostInputRequest;
use App\Services\Contracts\GameServiceInterface;
use App\Services\Contracts\CategoryServiceInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Services\Contracts\CommentServiceInterface;

class CategoryController extends BaseController
{
	protected $postService, $postRepos, $gameService, $catService, $catRepos, $commentService;

	public function __construct(
        PostServiceInterface $postService, 
        PostRepositoryInterface $postRepos, 
        GameServiceInterface $gameService, 
        CategoryServiceInterface $catService,
        CategoryRepositoryInterface $catRepos,
        CommentServiceInterface $commentService
    )
    {
        $this->postService = $postService;
        $this->postRepos = $postRepos;
        $this->gameService = $gameService;
        $this->catService = $catService;
        $this->catRepos = $catRepos;
        $this->commentService = $commentService;
        parent::__construct();
    }

    public function index($category)
    {
        $catSlug = isset($category) ? explode(".", $category)[0] : null;
        if(isset(explode(".", $category)[1]) && !in_array(explode(".", $category)[1], ['html', 'htm'])) {
            abort(404);
            return;
        }
        if(!$catSlug) {
            $categories = $this->catService->getListPagination();
            return view('category.index', ['categories' => $categories]);
        }
        $category = $this->catRepos->findBySlugOrId($catSlug);
        if(!$category) {
            abort(404);
            return;
        }
        $posts = $this->postService->getListPagination(WITH_PUBLIC_POST, ONLY_APPROVED_POST, null, $category->id);
        return view('category.view', ['posts' => $posts, 'category' => $category]);
    }
}
