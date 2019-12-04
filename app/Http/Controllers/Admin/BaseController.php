<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as Controller;
use App\Models\Post;
use Illuminate\Support\Facades\View;
class BaseController extends Controller
{
    protected $postService;

    public function __construct()
    {
        View::share('unapproved_post_count', Post::getNumberUnapprovedPost());
    }
}
