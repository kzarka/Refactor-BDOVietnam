<?php

namespace App\Repositories\Log;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\Log\ActivityLogRepositoryInterface;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Log\ActivityLog;

class ActivityLogRepository extends BaseRepository implements ActivityLogRepositoryInterface
{
	public function model()
    {
        return ActivityLog::class;
    }

    const VERBS = [
    	ACTION_CREATED => [
    		USER_TYPE => 'tạo hồ sơ',
    		POST_TYPE => 'tạo bài viết'
    	],
    	ACTION_UPDATED => [
    		USER_TYPE => 'cập nhật hồ sơ của',
    		POST_TYPE => 'cập nhật bài viết'
    	],
    	ACTION_DELETED => [
    		USER_TYPE => 'xóa thành viên',
    		POST_TYPE => 'xóa bài viết'
    	],
    	ACTION_BANNED => [
    		USER_TYPE => 'ban thành viên',
    	],
    	ACTION_APPROVED => [
    		POST_TYPE => 'phê duyệt bài viết'
    	]
    ];

    public function getListPagination($userId = null, $perPage = 10) 
    {
        $builder = $this->model->select('*');
        if($userId) {
            $builder->where('action', '=', ACTION_CREATED);
            $builder->orWhere('action', '=', ACTION_UPDATED);
            $builder->where('user_id', '=', $userId);
        }
        $builder->with('user', 'entity');
        $paginator = $this->addContentParams($builder->paginate($perPage));
        return $paginator;
    }

    public function addContentParams($paginator)
    {
    	$paginator->getCollection()->map(function($item) {
    		$item['verb'] = $this->getVerb($item->action, $item->entity_type);
    		if($item->entity_type == USER_TYPE) {
    			$item['action_name'] = $item->entity->full_name;
    			$item['action_url'] = $item->entity->url_admin;
                if($item->user_id == $item->entity_id) {
                    $item['myself'] = 'anh/cô ấy';
                }
    		}
    		if($item->entity_type == POST_TYPE) {
    			$item['action_name'] = $item->entity->title;
    			$item['action_url'] = $item->entity->url;
    		}
    		return $item;
    	});
    	return $paginator;
    }

    public function getVerb($verb, $type)
    {
    	\Log::info(self::VERBS[$verb][$type]);
    	return self::VERBS[$verb][$type];
    }
}