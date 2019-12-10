<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Services\Contracts\PostServiceInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories\Contracts\UserRepositoryInterface;

class AuthorController extends BaseController
{
	protected $postService, $postRepos, $userRepos;

	public function __construct(
        PostServiceInterface $postService, 
        PostRepositoryInterface $postRepos, 
        UserRepositoryInterface $userRepos
    )
    {
        $this->postService = $postService;
        $this->postRepos = $postRepos;
        $this->userRepos = $userRepos;
        parent::__construct();
    }

    public function index($author)
    {
        $username = isset($author) ? explode(".", $author)[0] : null;
        if(isset(explode(".", $author)[1]) && !in_array(explode(".", $author)[1], ['html', 'htm'])) {
            abort(404);
            return;
        }
        if(!$username) {
            abort(404);
            return;
        }
        $user = $this->userRepos->findBySlugOrId($username);
        if(!$user) {
            abort(404);
            return;
        }
        $posts = $this->postService->getListPagination(WITH_PUBLIC_POST, ONLY_APPROVED_POST, $user->id);
        return view('user.view', ['posts' => $posts, 'user' => $user]);
    }    
}
