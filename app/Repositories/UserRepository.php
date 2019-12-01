<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\User;
use Carbon\Carbon;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
	public function model()
    {
        return User::class;
    }

	public function userBuilder($all = false) {
    	$postCountBuilder = $this->model
	    	->select(\DB::raw("COUNT(posts.id) as posts"))
	    	->from('posts')
	    	->whereRaw('posts.id = users.id');
	    $commentCountBuilder = $this->model
	    	->select(\DB::raw("COUNT(comments.id) as comments"))
	    	->from('comments')
	    	->whereRaw('comments.id = users.id');

	    $builder = $this->model->select(
			'users.*',
			\DB::raw("({$commentCountBuilder->toSql()}) as comments"),
			\DB::raw("({$postCountBuilder->toSql()}) as posts"),
		);
    	if(!$all) {
    		$builder->active();
    	}
    	return $builder;
	}

    public function getListPagination($all = false, $perPage = 10) {
    	
		return $this->userBuilder($all)->paginate($perPage);
	}

	public function getList($all = false) {
		return $this->userBuilder($all)->get();
	}

	public function updateByAdmin($request, $id) {
		\DB::beginTransaction();
		try {
		    $record = $this->model->findOrFail($id);
			$record->update($request->all());
			if($request->hasFile('avatar') && $request->file('avatar')->isValid()){
				$record->clearMediaCollection(USER_MEDIA_COLLECTION);
				$fileName = 'user_' . md5($record->id) . time() . '.' . $request->file('avatar')->extension();
	            $record->addMediaFromRequest('avatar')->setFileName($fileName)->toMediaCollection(USER_MEDIA_COLLECTION);
	        }
		    \DB::commit();
		    return $record;
		} catch (\Exception $e) {
		    \DB::rollback();
		    throw new \Exception($e->getMessage());
		    return 'false';
		}
	}

	public function deleteByAdmin($id) {
		\DB::beginTransaction();
		try {
		    $record = $this->model->findOrFail($id);
			if($record) $record->delete();
		    \DB::commit();
		    return true;
		} catch (\Exception $e) {
		    \DB::rollback();
		    return false;
		}
	}

	public function liftBanByAdmin($id) {
		\DB::beginTransaction();
		try {
		    $record = $this->model->findOrFail($id);
			$record->update(['banned_until' => null]);
		    \DB::commit();
		    return true;
		} catch (\Exception $e) {
		    \DB::rollback();
		    return false;
		}
	}

	public function banByAdmin($id, $date) {
		\DB::beginTransaction();
		try {
			$ban_date = Carbon::now()->addDays($date);
		    $record = $this->model->findOrFail($id);
			$record->update(['banned_until' => $ban_date]);
		    \DB::commit();
		    return true;
		} catch (\Exception $e) {
		    \DB::rollback();
		    return false;
		}
	}
}