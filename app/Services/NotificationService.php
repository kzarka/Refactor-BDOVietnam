<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Services\Contracts\PostServiceInterface;
use Illuminate\Support\Collection;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\CommentRepositoryInterface;

use App\Models\Category;

class NotificationService
{
	protected $postRepos, $commentRepos;

	public function __construct(PostRepositoryInterface $postRepos, CommentRepositoryInterface $commentRepos) {
		$this->commentRepos = $commentRepos;
		$this->postRepos = $postRepos;
	}

	public function renderContent($notifications)
	{
		$renderItems = collect();
		foreach($notifications as $notification) {
			$data = json_decode($notification->data, true);
			switch ($data['type']) {
			 	case POST_COMMENT:
			 		$renderItems->push($this->renderNewCommentNotification($data, !!$notification->read_at));
			 		break;
			 	default:
			 		# code...
			 		break;
			}
		}
		return $renderItems;
	}

	public function renderNewCommentNotification($data, $isRead) {
		$commentId = isset($data['comment_id']) ? $data['comment_id'] : null;
		if(!$commentId) return null;
		$comment = $this->commentRepos->find($commentId)->with('author')->with('post')->first();
		if(!$comment) return null;
		return [
			'is_read' => $isRead,
			'from' => $comment->author->fullname,
			'to' => $comment->post->title,
			'sentence' =>  'đã đăng bình luận trong bài viết của bạn',
			'time' => $comment->created_from
		];
	}
}