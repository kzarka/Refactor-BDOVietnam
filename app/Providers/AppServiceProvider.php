<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Carbon\Translator;

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
        
        try {
            Translator::get('vi')->setTranslations([
                'months' => ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                'months_short' => ['Thg01', 'Thg02', 'Thg03', 'Thg04', 'Thg05', 'Thg06', 'Thg07', 'Thg08', 'Thg09', 'Thg10', 'Thg11', 'Thg12'],
                'weekdays' => ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'],
                'meridiem' => ['AM', 'PM'],
            ]);
            Carbon::setLocale(app()->getLocale());
            $recent_posts = Post::with('categories')->with('comments')->public()->where('approved', STATUS_APPROVED)->orderBy('created_at', 'DESC')->take(3)->get();
            $categories = Category::with('children')->active()->where('parent_id', 0)->orWhereNull('parent_id')->get();
            $recent_comments = Comment::with('post', 'author')->take(2)->orderBy('created_at', 'DESC')->get();
            View::share('header_categories', $categories);
            View::share('recent_posts', $recent_posts);
            View::share('recent_comments', $recent_comments);
        } catch (\Illuminate\Database\QueryException $e) {
            
        }
    }
}
