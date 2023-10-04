<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        session()->put('locale', 'en');
        app()->setLocale(session()->get('locale'));

        if(Schema::hasTable('categories')){
            $categories = Category::orderBy('ita', 'asc')->get();
            View::share('categories', $categories);
        }
    }
}
