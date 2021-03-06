<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\TagRepositoryInterface;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Post;
use Illuminate\Container\Container as Application;
use Carbon\Carbon;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    protected $tagRepos;

    public function __construct(TagRepositoryInterface $tagRepos, Application $app) {
        $this->tagRepos = $tagRepos;
        parent::__construct($app);
    }
	public function model()
    {
        return Post::class;
    }

    public function postsBuilder($catId = null, $userId = null, $tagId = null, $keyword = null) {
    	$builder = $this->model->select(
            'posts.*',
    		'users.username as username',
            \DB::raw('CONCAT_WS(" ", users.first_name, users.last_name) as author_name')
    	)
    	->leftJoin('users', 'users.id', '=', 'posts.author_id');
    	
    	if($catId) {
    		$builder->join('posts_categories as post_cat', function($join) {
                $join->on('post_cat.post_id', '=', 'posts.id');
            })
            ->whereRaw('post_cat.cat_id = ' . $catId);
    	}
    	if($userId) {
    		$builder->whereRaw('posts.author_id = ' . $userId);
    	}
        if($tagId) {
            $builder->join('posts_tags as post_tag', function($join) {
                $join->on('post_tag.post_id', '=', 'posts.id');
            })
            ->whereRaw('post_tag.tag_id = ' . $tagId);
        }

        if($keyword) {
            //$builder->whereRaw("posts.title LIKE '${keyword}'")
            //->orWhereRaw("posts.content LIKE '${keyword}'");
            $builder->search($keyword, 'posts');
        }
    	return $builder->available();
    }

    public function publicApproveFiler($builder, $public = WITH_PUBLIC_POST, $approved = ONLY_APPROVED_POST) {
        if($public == WITH_PUBLIC_POST) {
            $builder->public();
        }
        if($approved == ONLY_APPROVED_POST) {
            $builder->approved();
        } elseif($approved == ONLY_UNAPPROVED_POST) {
            $builder->where('approved', STATUS_UNAPPROVED);
        }
        return $builder;
    }

    public function getBuilderAvailable($catId = null, $userId = null, $tagId = null) {
        $builder = $this->postsBuilder($catId, $userId, $tagId);
        return $this->publicApproveFiler($builder);
    }

    public function getListPagination($public = WITH_PUBLIC_POST, $approved = ONLY_APPROVED_POST,  $userId = null, $catId = null, $tagId = null, $keyword = null, $perPage = 10) {
        $builder = $this->postsBuilder($catId, $userId, $tagId, $keyword);
        $builder = $this->publicApproveFiler($builder, $public, $approved);
        return $builder->with('comments', 'categories')->paginate($perPage);
    }

    public function getList($public = true, $approved = true) {
        $builder = $this->postsBuilder();
        $builder = $this->publicApproveFiler($builder, $public, $approved);
        return $builder->with('comments', 'categories')->get();
    }

    public function createByAdmin($request) {
        $user = auth()->user();
        $data = $request->all();
        $data['end_date'] = $this->parseDate($data['end_date']);
        $data['author_id'] = $user->id;
        if($user->authorizeRoles([ROLE_ADMIN, ROLE_MOD])) {
            $data['approved'] = STATUS_APPROVED;
        } else {
            $data['approved'] = STATUS_UNAPPROVED;
        }

        $record = $this->model->create($data);
        if(isset($data['category']) && is_array($data['category'])) {
            $record->categories()->attach($data['category']);
        }

        if(isset($data['tags'])) {
            $tags = $this->tagRepos->insertGetData($data['tags']);
            $record->tags()->attach($tags);
        }
        if($request->hasFile('images') && $request->file('images')->isValid()){
            $record->addMediaFromFileUpload($request->file('images'), POST_BANNER_COLLECTION);
        }
        return $record;
    }

    public function updateByAdmin($request, $id) {
        \DB::beginTransaction();
        try {
            $record = $this->model->findOrFail($id);
            if(!$record->canModify()) return false;
            
            $user = auth()->user();
            $data = $request->all();
            $data['end_date'] = $this->parseDate($data['end_date']);
            if(!auth()->user()->authorizeRoles([ROLE_ADMIN, ROLE_MOD])) {
                $data['approved'] = STATUS_UNAPPROVED;
            }
            $record->update($data);

            $record->categories()->detach();
            if(isset($data['category']) && is_array($data['category'])) {
                $record->categories()->attach($data['category']);
            }
            if($request->hasFile('images') && $request->file('images')->isValid()){
                \Log::info($request->file('images'));
                $record->removeMedias(POST_BANNER_COLLECTION);
                $record->addMediaFromFileUpload($request->file('images'), POST_BANNER_COLLECTION);
            }
            $record->tags()->detach();
            if(isset($data['tags'])) {
                $tags = $this->tagRepos->insertGetData($data['tags']);
                $record->tags()->attach($tags);
            }
            \DB::commit();
            return $record;
        } catch (\Exception $e) {
            \DB::rollback();
            throw new \Exception($e->getMessage());
            return false;
        }
    }

    public function deleteByAdmin($id) {
        \DB::beginTransaction();
        try {
            $record = $this->model->findOrFail($id);
            if(!$record->canDelete()) return false;
            $record->delete();
            \DB::commit();
            return $record;
        } catch (\Exception $e) {
            \DB::rollback();
            return false;
        }
    }

    public function approveByAdmin($id) {
        \DB::beginTransaction();
        try {
            $record = $this->model->findOrFail($id);
            if(!$record->canApprove()) return false;
            $record->update(['approved' => STATUS_APPROVED]);
            \Log::info($record);
            \DB::commit();
            return $record;
        } catch (\Exception $e) {
            \DB::rollback();
            return false;
        }
    }

    public function getNewestPost($catId = null, $perPage = 10)
    {
        $records = $this->getBuilderAvailable($catId)->with('categories')->with('comments')->orderBy('created_at', 'DESC')->paginate($perPage);
        return $this->getImages($records);
    }

    public function getTopPost($catId = null, $perPage = 10)
    {
        $records = $this->getBuilderAvailable()->with('categories')->with('comments')->orderBy('view_count', 'DESC')->paginate($perPage);
        return $this->getImages($records);
    }

    public function findBySlugOrId($slug)
    {
        try {
            $builder = $this->getBuilderAvailable();
            if(is_numeric($slug)) {
                return $builder->where('posts.id', $slug)->with('comments')->with('tags')->first();
            }
            return $builder->where('slug', $slug)->with('comments')->with('tags')->first();
        } catch (\Exception $e) {
            \Log::info($e);
            return false;
        }
        
    }

    public function getRelatePost($postId, $catId)
    {
        if($catId) {
            $records = $this->getBuilderAvailable($catId)->where('posts.id', '<>', $postId)->with('categories')->with('comments')->inRandomOrder()->take(2)->get();
        }
        $records = $this->getBuilderAvailable()->where('posts.id', '<>', $postId)->with('categories')->with('comments')->inRandomOrder()->take(2)->get();
        return $this->getImages($records);
    }

    /**
     * Get random Top Post
     */
    public function getRandomTop($count = 3)
    {
        $records = $this->getBuilderAvailable()->with('categories')->with('comments')->inRandomOrder()->take($count)->get();
        return $this->getImages($records);
    }

    public function getImages($records) {
        $records->map(function($record) {
            $record->banner_image = $record->getFirstMediaUrl(POST_BANNER_COLLECTION);
            $record->thumbnail = $record->getFirstThumbnailUrl(POST_BANNER_COLLECTION);
            return $record;
        });
        return $records;
    }

    public function parseDate ($date)
    {
        if($date == '0000-00-00 00:00:00' || !$date) return null;
        return Carbon::parse($date)->format('Y-m-d H:i:s');
    }
}