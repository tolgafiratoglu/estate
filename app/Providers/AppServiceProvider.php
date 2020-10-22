<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;

use App\Repositories\MenuRepository;
use App\Repositories\SystemDefaultsRepository;
use App\Repositories\SystemSettingsRepository;
use App\Repositories\SystemMediaRepository;

use Illuminate\Support\Facades\Schema;

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
    public function boot(MenuRepository $menuRepository,
                        SystemSettingsRepository $systemSettingsRepository,
                        SystemDefaultsRepository $systemDefaultsRepository,
                        SystemMediaRepository $systemMediaRepository)
    {
       
        // Share header menu with all templates:
        if(Schema::hasTable('menu') != false) 
        {
            // Header menu content:
            $menuTree = $menuRepository->getMenuTree("header", null);
            $headerMenuContent = build_header_menu($menuTree);
            View::share('headerMenu', $headerMenuContent);
        }

        // Share header related settings with all templates:
        if(Schema::hasTable('system_settings') != false) 
        {
            // Header settings:
            $headerSettings = $systemSettingsRepository->getSettingByContext("header");
            View::share('headerSettings', $headerSettings);
        }
        
        // Share header related defaults with all templates:
        if(Schema::hasTable('system_defaults') != false) 
        {
            // Header default values:
            $headerDefaults = $systemDefaultsRepository->getSettingsByContext("header");
            View::share('headerDefaults', $headerDefaults);
            // Social media default values:
            $socialMedia = $systemDefaultsRepository->getSettingsByContext("social_media");
            View::share('headerSocialMedia', $headerDefaults);
        }

        // Share logo with all templates
        if(Schema::hasTable('system_media') != false) 
        {
            // Header settings:
            $headerSettings = $systemMediaRepository->getSetting("header_logo");
            View::share('headerLogo', $headerSettings);
        }

    }
}
