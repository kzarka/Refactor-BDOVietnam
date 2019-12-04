<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\BaseController;
use App\Services\Contracts\PostServiceInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories\Contracts\TagRepositoryInterface;

class TagController extends BaseController
{
    protected $postService, $postRepos, $tagRepos;

    public function __construct(
        PostServiceInterface $postService, 
        PostRepositoryInterface $postRepos, 
        TagRepositoryInterface $tagRepos
    )
    {
        $this->postService = $postService;
        $this->postRepos = $postRepos;
        $this->tagRepos = $tagRepos;
        parent::__construct();
    }

    public function index($tag)
    {
        $tagSlug = $tag;
        if(!$tagSlug) {
            abort(404);
            return;
        }
        $tag = $this->tagRepos->findBySlugOrId($tagSlug);
        if(!$tag) {
            abort(404);
            return;
        }
        $posts = $this->postService->getListPagination(WITH_PUBLIC_POST, ONLY_APPROVED_POST, null, null, $tag->id);
        return view('tag.view', ['posts' => $posts, 'tag' => $tag]);
    }
}
