<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Admin\BaseController;
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
        parent::__construct();
    }

    public function index(Request $request)
    {
        $records = $this->postService->getListPagination(WITH_UNPUBLIC_POST, WITH_UNAPPROVED_POST, $request->user()->id);
        return view('admin.post.index', ['posts' => $records]);
    }

    public function create(Request $request) {
        $games = $this->gameService->getList();
        $categories = $this->catService->getParentListWithChild();
        return view('admin.post.create', ['games' => $games, 'categories' => $categories]);
    }

    public function edit(Request $request, $id) {
        $post = $this->postRepos->find($id);
        if(!$post || !$post->canModify()) {
            $this->saveSessionErrorMessage('You cant edit this post');
            return redirect()->route('admin.post.index');
        }
        $games = $this->gameService->getList();
        $categories = $this->catService->getParentListWithChild();
        return view('admin.post.edit', [
            'post' => $post, 
            'categories' => $categories, 
            'games' => $games,
            'route' => 'post.edit'
        ]);
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
        $result = $this->postRepos->createByAdmin($request->all());
        if($result){
            $this->saveSessionSuccessMessage('Updated!');
            return redirect()->route('admin.post.index');
        }
        $this->saveSessionErrorMessage('Error!');
        return redirect()->route('admin.post.index');
    }

    public function destroy($id)
    {
        $result = $this->postRepos->deleteByAdmin($id);
        if($result){
            $this->saveSessionSuccessMessage('Deleted!');
            return redirect()->route('admin.post.index');
        }
        $this->saveSessionErrorMessage('You cant delete this post!');
        return redirect()->route('admin.post.index');
    }

    public function load(Request $request) {
        return $this->postService->getPostList();
    }

    public function approve(Request $request) {
        if($request->method() == 'GET') {
            $records = $this->postService->getListPagination(WITH_UNPUBLIC_POST, ONLY_UNAPPROVED_POST);
            return view('admin.post.approve', ['posts' => $records]);
        }
        $id = $request->get('id');
        $result = $this->postRepos->approveByAdmin($id);
        if($result){
            $this->saveSessionSuccessMessage('Approve!');
            return redirect()->route('admin.post.approve');
        }
        $this->saveSessionErrorMessage('You cant approve this post!');
        return redirect()->route('admin.post.approve');
    }

    public function manage(Request $request)
    {
        $records = $this->postService->getListPagination(WITH_UNPUBLIC_POST, ONLY_APPROVED_POST);
        return view('admin.post.manage', ['posts' => $records]);
    }

    public function preview($postId = null)
    {
        if($postId) {
            $post = $this->postRepos->find($postId);
            if($post) {
                return view('admin.post.view', ['post' => $post]);
            }
            $this->saveSessionErrorMessage('Bài viết này không thể xem trước');
            return redirect()->back();
        }

        $post = [
            'content' => request()->get('content'),
            'title' => request()->get('title')
        ];
        return view('admin.post.view', ['post' => $post]);
    }
}
