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
			\DB::raw("({$postCountBuilder->toSql()}) as posts")
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
				$record->removeMedias(USER_AVATAR_COLLECTION_DEFAULT);
				$fileName = 'user_' . md5($record->id) . time() . '.' . $request->file('avatar')->extension();
	            $record->addMediaFromFileUpload($request->file('avatar'), USER_AVATAR_COLLECTION_DEFAULT, $fileName);
	        }
	        $data = $request->all();
            if(isset($data['roles']) && is_array($data['roles'])) {
            	$record->roles()->detach();
                $record->roles()->attach($data['roles']);
            }
		    \DB::commit();
		    return $record;
		} catch (\Exception $e) {
		    \DB::rollback();
		    \Log::info($e->getMessage());
		    return false;
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

	public function selfUpdate($request, $userId)
	{
		\DB::beginTransaction();
		try {
		    $record = $this->model->findOrFail($userId);
		    $data = $request->all();
		    if($request->get('banned_until') || $request->get('active'))
		    {
		    	$data['banned_until'] = null;
		    	$data['active'] = $record->active;
		    }
			$record->update($data);
			if($request->hasFile('avatar') && $request->file('avatar')->isValid()){
				$record->removeMedias();
				$fileName = 'user_' . md5($record->id) . time() . '.' . $request->file('avatar')->extension();
	            $record->addMediaFromFileUpload($request->file('avatar'), USER_AVATAR_COLLECTION, $fileName);
	        }
		    \DB::commit();
		    return true;
		} catch (\Exception $e) {
		    \DB::rollback();
		    \Log::info($e->getMessage());
		    return false;
		}
	}

	public function findGetAvatar($id)
	{
		return $this->model->with('comments')->where('id', $id)->first();
	}

	public function getNoficationPagination($userId)
	{
		$item = \DB::table('notifications')->select('*')->where('notifiable_id', '=', $userId)->paginate(5);
		$ids = $item->getCollection()->pluck('id')->where('read_at', null)->toArray();
		\Log::info($item->getCollection());
		$this->model->select('*')->from('notifications')->whereIn('id', $ids)->update(['read_at' => Carbon::now()]);
		return $item;
	}

	public function findBySlugOrId($username) {
		try {
            if(is_numeric($username)) {
                return $this->model->findOrFail($username);
            }
            return $this->model->where('username', $username)->with('comments')->first();
        } catch (\Exception $e) {
            return false;
        }
	}
}