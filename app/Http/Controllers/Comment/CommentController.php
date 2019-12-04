<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\BaseController;
use App\Services\Contracts\PostServiceInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Services\Contracts\CommentServiceInterface;

class CommentController extends BaseController
{
	protected $postService, $postRepos, $commentService, $commentRepos;

	public function __construct(
        PostServiceInterface $postService, 
        PostRepositoryInterface $postRepos, 
        CommentServiceInterface $commentService,
        CommentRepositoryInterface $commentRepos
    )
    {
        $this->postService = $postService;
        $this->postRepos = $postRepos;
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
