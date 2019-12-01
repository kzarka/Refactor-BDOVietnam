<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\BaseController;
use App\Services\Contracts\PostServiceInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PostInputRequest;
use App\Services\Contracts\GameServiceInterface;
use App\Services\Contracts\CategoryServiceInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Services\Contracts\CommentServiceInterface;

class CommentController extends BaseController
{
	protected $postService, $postRepos, $gameService, $catService, $catRepos, $commentService, $commentRepos;

	public function __construct(
        PostServiceInterface $postService, 
        PostRepositoryInterface $postRepos, 
        GameServiceInterface $gameService, 
        CategoryServiceInterface $catService,
        CategoryRepositoryInterface $catRepos,
        CommentServiceInterface $commentService,
        CommentRepositoryInterface $commentRepos
    )
    {
        $this->postService = $postService;
        $this->postRepos = $postRepos;
        $this->gameService = $gameService;
        $this->catService = $catService;
        $this->catRepos = $catRepos;
        $this->commentService = $commentService;
        $this->commentRepos = $commentRepos;
        parent::__construct();
    }

    public function store(Request $request)
    {
        $postId = $request->get('post_id');
        $post = $this->postRepos->find($postId);
        if(!$post) return redirect()->to(url()->previous() . '#comments');
        $data = $request->all();

        if(!$user = $request->user()) {
            $data['name'] = $data['name'] ?? 'Người Vô Hình';
        } else {
            $data['author_id'] = $user->id;
        }
        $this->commentRepos->create($data);
        return redirect()->to(url()->previous() . '#comments');
    }    
}
