<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\BaseController;
use App\Services\Contracts\UserServiceInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserRequest;

class UserController extends BaseController
{
	protected $userService, $userRepos;

	public function __construct(UserServiceInterface $userService, UserRepositoryInterface $userRepos)
    {
        $this->userService = $userService;
        $this->userRepos = $userRepos;
        parent::__construct();
    }

    public function index(Request $request)
    {
    	$records = $this->userService->getListPagination();
        $records->map(function ($record, $key) {
            $record->avatar = $record->getFirstMediaUrl(USER_MEDIA_COLLECTION);
            $record->thumbnail = $record->getFirstMediaUrl(USER_MEDIA_COLLECTION, THUMB_CONVERSION);
            return $record;
        });
        return view('admin.user.index', ['users' => $records]);
    }

    public function create(Request $request) {
        return view('admin.post.create');
    }

    public function edit(Request $request, $id) {
        $user = $this->userService->findGetAvatar($id);
        return view('admin.user.edit', [
            'user' => $user
        ]);
    }

    public function update(UserRequest $request, $id)
    {
        $result = $this->userRepos->updateByAdmin($request, $id);
        if($result){
            $this->saveSessionSuccessMessage('Updated!');
            return redirect()->route('admin.user.index');
        }
        $this->saveSessionErrorMessage('You update this user!');
        return redirect()->route('admin.user.index');
    }

    public function store(UserRequest $request)
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
        $result = $this->userRepos->deleteByAdmin($id);
        if($result){
            $this->saveSessionSuccessMessage('Deleted!');
            return redirect()->route('admin.user.index');
        }
        $this->saveSessionErrorMessage('You cant delete this user!');
        return redirect()->route('admin.user.index');
    }

    public function load(Request $request) {
        return $this->postService->getPostList();
    }

    public function approve(Request $request) {
        if($request->method() == 'GET') {
            $records = $this->postService->getPostListPagination(WITH_UNPUBLIC_POST, ONLY_UNAPPROVED_POST);
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

    public function ban(Request $request)
    {
        $userId = $request->get('user_id');
        $date = $request->get('banned_until');

        $result = $this->userRepos->banByAdmin($userId, $date);
        if($result){
            $this->saveSessionSuccessMessage('Banned!');
            return redirect()->route('admin.post.index');
        }
        $this->saveSessionErrorMessage('You cant ban this user!');
        return redirect()->route('admin.post.index');
    }

    public function lift($id)
    {
        $result = $this->userRepos->banByAdmin($id);
        if($result){
            $this->saveSessionSuccessMessage('Banned!');
            return redirect()->route('admin.post.index');
        }
        $this->saveSessionErrorMessage('You cant ban this user!');
        return redirect()->route('admin.post.index');
    }
}
