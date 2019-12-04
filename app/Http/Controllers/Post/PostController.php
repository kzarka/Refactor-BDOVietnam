<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\BaseController;
use App\Services\Contracts\PostServiceInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PostInputRequest;
use App\Services\Contracts\GameServiceInterface;
use App\Services\Contracts\CategoryServiceInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Services\Contracts\CommentServiceInterface;
use Illuminate\Support\Facades\Event;

class PostController extends BaseController
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

    public function index(Request $request)
    {
        $records = $this->postService->getListPagination();
        return view('post.index', ['posts' => $records]);
    }

    /**
     * Find a post by category slug and post slug
     */
    public function view($category, $post)
    {
        dd(auth()->user()->notifications);
        $postSlug = isset($post) ? explode(".", $post)[0] : null;
        if(isset(explode(".", $post)[1]) && !in_array(explode(".", $post)[1], ['html', 'htm'])) {
            abort(404);
            return;
        }
        $post = $this->postRepos->findBySlugOrId($postSlug);
        if($post) {
            $post->banner_image = $post->getFirstMediaUrl(POST_BANNER_COLLECTION);
            $post->thumbnail = $post->getFirstThumbnailUrl(POST_BANNER_COLLECTION);
        }
        if(!$post) {
            abort(404);
            return;
        }
        if($category && $category != DEFAULT_CATEGORY) {
            $category = $this->catRepos->findBySlugOrId($category);
            if(!$category) {
                abort(404);
                return;
            }
            $categories = $post->categories()->pluck('categories.id')->toArray();
            if(!in_array($category->id, $categories)) {
                abort(404);
                return;
            }
        }
        $catId = isset($category->id) ? $category->id : null;
        $related_posts = $this->postService->getRelatePost($post->id, $catId);
        $comments = $this->commentService->getCommentsByPost($post->id);
        Event::dispatch('posts.view', $post);
        return view('post.view', ['post' => $post, 'comments' => $comments, 'related_posts' => $related_posts]);
    }
}
