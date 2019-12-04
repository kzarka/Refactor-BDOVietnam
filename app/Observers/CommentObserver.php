<?php

namespace App\Observers;

use App\Services\Contracts\PostServiceInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Services\Contracts\CommentServiceInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Notifications\CommentNotification;
use App\Models\Comment;

class CommentObserver
{

    protected $postService, $postRepos, $commentService, $commentRepos, $userRepos;

    public function __construct(
        PostServiceInterface $postService, 
        PostRepositoryInterface $postRepos, 
        CommentServiceInterface $commentService,
        CommentRepositoryInterface $commentRepos,
        UserRepositoryInterface $userRepos
    )
    {
        $this->postService = $postService;
        $this->postRepos = $postRepos;
        $this->commentService = $commentService;
        $this->commentRepos = $commentRepos;
        $this->userRepos = $userRepos;
    }
    /**
     * Handle the comment "created" event.
     *
     * @param  \App\Comment  $comment
     * @return void
     */
    public function created(Comment $comment)
    {
        $post = $this->postRepos->find($comment->post_id);
        \Log::info($comment);
        if(!$post) return;
        $author = $this->userRepos->find($post->author_id);
        $author->notify(new CommentNotification($comment));
    }

    /**
     * Handle the comment "updated" event.
     *
     * @param  \App\Comment  $comment
     * @return void
     */
    public function updated(Comment $comment)
    {
        //
    }

    /**
     * Handle the comment "deleted" event.
     *
     * @param  \App\Comment  $comment
     * @return void
     */
    public function deleted(Comment $comment)
    {
        //
    }

    /**
     * Handle the comment "restored" event.
     *
     * @param  \App\Comment  $comment
     * @return void
     */
    public function restored(Comment $comment)
    {
        //
    }

    /**
     * Handle the comment "force deleted" event.
     *
     * @param  \App\Comment  $comment
     * @return void
     */
    public function forceDeleted(Comment $comment)
    {
        //
    }
}
