<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Carbon\Translator;
use App\Models\SystemVariable;
use App\Observers\CommentObserver;
use App\Observers\PostObserver;
use App\Observers\UserObserver;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     
 *    * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Services\Contracts\GameServiceInterface::class, \App\Services\Game\GameService::class);
        $this->app->bind(\App\Services\Contracts\CategoryServiceInterface::class, \App\Services\Category\CategoryService::class);
        $this->app->bind(\App\Services\Contracts\PostServiceInterface::class, \App\Services\Post\PostService::class);
        $this->app->bind(\App\Services\Contracts\UserServiceInterface::class, \App\Services\User\UserService::class);
        $this->app->bind(\App\Services\Contracts\CommentServiceInterface::class, \App\Services\Comment\CommentService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerObservers();
        try {
            Translator::get('vi')->setTranslations([
                'months' => ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                'months_short' => ['Thg01', 'Thg02', 'Thg03', 'Thg04', 'Thg05', 'Thg06', 'Thg07', 'Thg08', 'Thg09', 'Thg10', 'Thg11', 'Thg12'],
                'weekdays' => ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'],
                'meridiem' => ['AM', 'PM'],
            ]);
            Carbon::setLocale(app()->getLocale());
            $sys_vars_record = SystemVariable::all();
            $sys_vars = [];
            foreach ($sys_vars_record as $var) {
                $sys_vars[$var->name] = $var->value;
            }
            $recent_posts = Post::with('categories')->with('comments')->public()->where('approved', STATUS_APPROVED)->orderBy('created_at', 'DESC')->take(3)->get();
            $recent_posts->map(function($record) {
                $record->banner_image = $record->getFirstMediaUrl(POST_BANNER_COLLECTION);
                $record->thumbnail = $record->getFirstThumbnailUrl(POST_BANNER_COLLECTION);
                return $record;
            });
            $categories = Category::with('children')->active()->where('parent_id', 0)->orWhereNull('parent_id')->get();
            $recent_comments = Comment::with('post', 'author')->take(2)->orderBy('created_at', 'DESC')->get();
            $top_tags = Tag::select('tags.*', \DB::raw("COUNT(posts_tags.post_id) as post_count"))
                ->join('posts_tags', 'tags.id', '=', 'posts_tags.tag_id')
                ->join('posts', 'posts.id', '=', 'posts_tags.post_id')
                ->groupBy('tags.id')
                ->take(10)->orderBy('post_count', 'DESC')->get();
            View::share('header_categories', $categories);
            View::share('recent_posts', $recent_posts);
            View::share('recent_comments', $recent_comments);
            View::share('sys_vars', $sys_vars);
            View::share('top_tags', $top_tags);
        } catch (\Illuminate\Database\QueryException $e) {
            \Log::info($e);
        }
    }

    public function registerObservers() {
        Comment::observe(CommentObserver::class);
        User::observe(UserObserver::class);
        Post::observe(PostObserver::class);
    }
}
