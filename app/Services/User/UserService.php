<?php

namespace App\Services\User;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Support\Collection;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Models\Category;

class UserService implements UserServiceInterface
{
	protected $userRepos;

	public function __construct(UserRepositoryInterface $userRepos) {
		$this->userRepos = $userRepos;
	}

	public function getListPagination($all = false, $perPage = 10) {
		return $this->userRepos->getListPagination($all, $perPage);
	}

	public function getList($all = false) {
		return $this->userRepos->getList($all);
	}

	public function findGetAvatar($id)
	{
		$record = $this->userRepos->findBySlugOrId($id);
		if(!$record) return false;
		$record->avatar = $record->getFirstMediaUrl(USER_AVATAR_COLLECTION);
        $record->thumbnail = $record->getFirstMediaUrl(USER_AVATAR_COLLECTION);
        return $record;
	}
}