<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
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
    	$topPost = $this->postService->getTopPost(null, 5);
    	$newests = $this->postService->getNewestPost(null, 5);
        return view('index', ['top_posts' => $topPost, 'newests' => $newests]);
    }
}