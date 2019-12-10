<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\BaseController;
use App\Services\Contracts\UserServiceInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\UserInputRequest;
use App\Models\Role;
use App\Services\NotificationService;


class UserController extends BaseController
{
	protected $userService, $userRepos, $notiService;

	public function __construct(UserServiceInterface $userService, UserRepositoryInterface $userRepos, NotificationService $notiService)
    {
        $this->userService = $userService;
        $this->userRepos = $userRepos;
        $this->notiService = $notiService;
        parent::__construct();
    }

    public function index(Request $request)
    {
    	$records = $this->userService->getListPagination();
        $records->map(function ($record, $key) {
            $record->avatar = $record->getFirstMediaUrl(USER_AVATAR_COLLECTION);
            $record->thumbnail = $record->getFirstMediaUrl(USER_AVATAR_COLLECTION_THUMB_SMALL);
            return $record;
        });
        return view('admin.user.index', ['users' => $records]);
    }

    public function create(Request $request) {
        $roles = Role::all();
        return view('admin.post.create', ['roles' => $roles]);
    }

    public function edit(Request $request, $id) {
        $user = $this->userService->findGetAvatar($id);
        $roles = Role::all();
        return view('admin.user.edit', ['user' => $user, 'roles' => $roles]);
    }

    public function update(UserInputRequest $request, $id)
    {
        $result = $this->userRepos->updateByAdmin($request, $id);
        if($result){
            $this->saveSessionSuccessMessage('Updated!');
            return redirect()->route('admin.user.index');
        }
        $this->saveSessionErrorMessage('You update this user!');
        return redirect()->route('admin.user.index');
    }

    public function store(UserInputRequest $request)
    {
        $result = $this->postRepos->createByAdmin($request->all());
        $roles = Role::all();
        if($result){
            $this->saveSessionSuccessMessage('Updated!');
            return redirect()->route('admin.post.index');
        }
        $this->saveSessionErrorMessage('Error!');
        return redirect()->route('admin.post.index', ['roles' => $roles]);
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
            return redirect()->route('admin.user.index');
        }
        $this->saveSessionErrorMessage('You cant ban this user!');
        return redirect()->route('admin.user.index');
    }

    public function lift($id)
    {
        $result = $this->userRepos->banByAdmin($id);
        if($result){
            $this->saveSessionSuccessMessage('Banned!');
            return redirect()->route('admin.user.index');
        }
        $this->saveSessionErrorMessage('You cant ban this user!');
        return redirect()->route('admin.user.index');
    }

    public function selfUpdate(UserInputRequest $request)
    {
        $user = $this->userService->findGetAvatar($request->user()->id);
        if($request->method() == 'GET') {
            return view('admin.user.edit', [
                'self' => $user
            ]); 
        }
        $result = $this->userRepos->selfUpdate($request, $user->id);
        if($result){
            $this->saveSessionSuccessMessage('Đã cập nhật hồ sơ');
            return redirect()->route('admin.user.profile');
        }
        $this->saveSessionErrorMessage('Không thể cập nhật hồ sơ của bạn.');
        return redirect()->route('admin.user.self_update');
    }

    public function profile($id = null)
    {
        $id = $id ?? auth()->user()->id;
        $user = $this->userService->findGetAvatar($id);
        if(!$user) {
            $this->saveSessionErrorMessage('Profile not found.');
            return redirect()->route('admin.dashboard');
        }
        return view('admin.user.profile', [
            'user' => $user
        ]); 
    }

    public function getNofication(Request $request)
    {
        $page = $request->get('page');
        $userId = $request->user()->id;
        $notiPagination = $this->userRepos->getNoficationPagination($userId);
        $result = $this->notiService->renderContent($notiPagination->getCollection());
        return $this->respondWithSuccess($result);
    }
}
