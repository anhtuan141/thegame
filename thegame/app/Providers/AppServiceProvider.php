<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Func;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        //Paginator Use Bootstrap
        Paginator::useBootstrap();

        //frontend
        View::composer(['*'], function ($view) {
            $category = Category::where('status', 1)->get();
            $view->with('collection3', $category);
        });

        //BackEnd
        View::composer(['backend.widgets.slidebar'], function ($view) {
            $user = auth()->user();
            if ($user->id) {
                $menus = Func::_listmenuforuser($user->id);
                $view->with('menus', $menus);
                $view->with('uid', $user->id);
            }
        });
    }
}
