<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\TagRepositoryInterface;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Tag;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
	public function model()
    {
        return Tag::class;
    }

    public function getAllTag() {
        return $this->model->select('*')->with('posts')->get();
    }
    /**
	 * @param String $tags
     */
    public function insertGetData($tags) {
    	$tags = explode(',', $tags);
    	$tagsCollection = $this->model->whereIn('name', $tags)->get();
    	$inDBTags = $tagsCollection->pluck('name')->toArray();
    	$tagsNotInDB = array_diff($tags, $inDBTags);
    	$insert = [];
    	foreach($tagsNotInDB as $tag) {
            if(strlen($tag) <= 1 || strlen($tag) > 20) continue;
    		$insert[] = [
    			'name' => $tag,
                'slug' => $this->to_slug($tag)
    		];
    	}
    	$this->model->insert($insert);
    	$tagsCollection = $this->model->whereIn('name', $tags)->get();
    	return $tagsCollection;
    }

    public function to_slug($str) {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
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