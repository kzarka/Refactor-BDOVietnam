<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Services\Contracts\PostServiceInterface;

class MainController extends BaseController
{
	protected $postService;

	public function __construct(PostServiceInterface $postService)
    {
    	$this->postService = $postService;
        parent::__construct();
    }
    public function index()
    {
    	$topPost = $this->postService->getRandomTop();
    	$newests = $this->postService->getNewestPost(null, 5);
        return view('index', ['top_posts' => $topPost, 'newests' => $newests]);
    }

    public function search(Request $request)
    {
        $keyword = $request->get('q');
        if(strlen($keyword) < 3) {
            return view('search', ['results' => []]);
        }
        $results = $this->postService->getListPagination(WITH_PUBLIC_POST, ONLY_APPROVED_POST, null, null, null, $keyword);
        return view('search', ['results' => $results]);
    }
}
