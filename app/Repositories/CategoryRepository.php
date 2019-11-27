<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Category;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
	public function model()
    {
        return Category::class;
    }

    public function categoryBuilder($all = false, $exceptId = null) {
		$builder = $this->model->select('*');
    	if(!$all) {
    		$builder->active();
    	}
    	if($exceptId) {
    		$builder->whereNotIn('id', function($query) use ($exceptId) {				
				$query->select('id')
              	->from('categories')
              	->where('parent_id', $exceptId); /* Take child ids of this category to exclude */
			});
			$builder->whereNotIn('id', [$exceptId]);
    	}
    	return $builder;
	}

    public function getCategoryListPagination($all = false, $exceptId = null, $perPage = 10) {
    	
		return $this->categoryBuilder($all, $exceptId)->paginate($perPage);
	}

	public function getCategoryList($all = false, $exceptId = null) {
		return $this->categoryBuilder($all, $exceptId)->get();
	}

	public function updateByAdmin($data, $id) {
		\DB::beginTransaction();
		try {
		    $record = $this->model->findOrFail($id);
			$record->update($data);
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
}