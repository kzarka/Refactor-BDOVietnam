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

    public function getCategoryList($perPage = 10) {
		$records = $this->model->select(
			'categories.*',
			'sub.name as parent_name'
		)->leftJoin('categories as sub', 'categories.parent_id', 'sub.id');
		return $records->paginate($perPage);
	}

	public function loadCategorySelect($exceptId) {
		$records = $this->model->select('*');
		if($exceptId) {
			$records->whereNotIn('id', function($query) use ($exceptId) {				
				$query->select('id')
              	->from('categories')
              	->where('parent_id', $exceptId); /* Take child ids of this category to exclude */
			});
			$records->whereNotIn('id', [$exceptId])->where('active', STATUS_ACTIVE);

		}
		return $records->get();
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