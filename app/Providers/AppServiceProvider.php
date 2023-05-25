<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\SidebarAdvertisement;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\TopAdvertisement;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        $top_ad_data = TopAdvertisement::where('id', 1)->first();
        $sidebar_top_ad = SidebarAdvertisement::where('sidebar_ad_location', 'Top')->get();
        $sidebar_bottom_ad = SidebarAdvertisement::where('sidebar_ad_location', 'Bottom')->get();
        $recent_news_data = Post::with('rSubCategory')->orderBy('id', 'desc')->limit(5)->get();
        $popular_news_data = Post::with('rSubCategory')->orderBy('visitors', 'desc')->limit(5)->get();

        $categories = Category::with('rSubCategory')->where('show_on_menu','Show')->orderBy('category_order','asc')->get();

        view()->share('global_top_ad_data', $top_ad_data);
        view()->share('global_sidebar_top_ad', $sidebar_top_ad);
        view()->share('global_sidebar_bottom_ad', $sidebar_bottom_ad);
        view()->share('global_categories', $categories);
        view()->share('global_recent_news_data', $recent_news_data);
        view()->share('global_popular_news_data', $popular_news_data);

    }
}
