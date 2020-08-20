<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;

use App\Repositories\MenuRepository;

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
    public function boot(MenuRepository $menuRepository)
    {
       
        $menuTree = $menuRepository->getMenuTree("header", null);

        View::share('menu', "test");

    }
}
