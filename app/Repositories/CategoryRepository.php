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
		$builder = $this->model->select('categories.*', 'c2.name as parent_name');
    	if(!$all) {
    		$builder->where('categories.active', STATUS_ACTIVE);
    	}
    	$builder->leftJoin('categories as c2', 'c2.id', '=', 'categories.parent_id');
    	if($exceptId) {
    		$builder->whereNotIn('categories.id', function($query) use ($exceptId) {				
				$query->select('c3.id')
              	->from('categories as c3')
              	->where('c3.parent_id', $exceptId); /* Take child ids of this category to exclude */
			});
			$builder->whereNotIn('categories.id', [$exceptId]);
    	}
    	return $builder;
	}

    public function getListPagination($all = false, $exceptId = null, $perPage = 10) {
    	
		return $this->categoryBuilder($all, $exceptId)->paginate($perPage);
	}

	public function getList($all = false, $exceptId = null) {
		return $this->categoryBuilder($all, $exceptId)->get();
	}

	public function getParentListWithChild($all = false, $exceptId = null) {
		return $this->categoryBuilder($all, $exceptId)
			->whereNull('categories.parent_id')
			->orWhere('categories.parent_id', 0)
			->with('children')->get();
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

	public function findBySlugOrId($slug)
    {
        try {
            if(is_numeric($slug)) {
                return $this->model->findOrFail($slug);
            }
            return $this->model->where('slug', $slug)->first();
        } catch (\Exception $e) {
            return false;
        }
    }
}