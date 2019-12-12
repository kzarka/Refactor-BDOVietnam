<?php

namespace App\Http\Controllers\Admin\Comment;

use App\Http\Controllers\Admin\BaseController;
use App\Services\Contracts\CommentServiceInterface;
use App\Repositories\Contracts\CommentRepositoryInterface;
use Illuminate\Http\Request;

class CommentController extends BaseController
{
	protected $commentService, $commentRepos;

	public function __construct(CommentServiceInterface $commentService, CommentRepositoryInterface $commentRepos)
    {
        $this->commentService = $commentService;
        $this->commentRepos = $commentRepos;
        parent::__construct();
    }

    public function index(Request $request)
    {
    	$comments = $this->commentService->getListPagination();
        return view('admin.comment.index', ['comments' => $comments]);
    }
}
