<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Services\Contracts\PostServiceInterface;
use Illuminate\Support\Collection;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Models\Category;

class NotificationService
{
	protected $postRepos;

	public function __construct(PostRepositoryInterface $postRepos) {
		$this->postRepos = $postRepos;
	}

	public function renderContent($notifications)
	{
		$renderItems = collect();
	}

	public function renderNewComment($data, $isRead) {
		$commentId = isset($data['comment_id']) ? $data['comment_id'] : null;
		if(!$commentId) return null;
		$comment = $this->commentRepos->where('id', $commentId)->with('author')->with('post')->first();
		if(!$comment) return null;
		return [
			'is_read' => $isRead,
			'content' => $comment->author->fullname . 'đã đăng bình luận trong bài viết của bạn ' . $comment->post->title
		]
	}
}