<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\PropertyRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\SystemSettingsRepository;
use App\Repositories\SystemMediaRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(PropertyRepository $propertyRepository, 
                          ProjectRepository $projectRepository,
                          SystemSettingsRepository $systemSettingsRepository,
                          SystemMediaRepository $systemMediaRepository)
    {

        // Home page settings:
        $settings = [];
            $settings["show_latest_properties"] = $systemSettingsRepository->getSetting("main_page_show_latest_properties");
            $settings["show_latest_projects"] = $systemSettingsRepository->getSetting("main_page_show_latest_projects");
            $settings["show_latest_blogs"] = $systemSettingsRepository->getSetting("main_page_show_latest_blogs");
            $settings["show_search"] = $systemSettingsRepository->getSetting("main_page_show_search");

        // Retrive latest properties, projects and blogs:
        $latestProperties = $propertyRepository->getPropertyList(false, 'approved', false, 0, 4, 'id', 'DESC');
        $latestProjects = $projectRepository->getProjectList(false, 'approved', false, 0, 4, 'id', 'DESC');

        // Set template args:
        $templateArgs = ["settings"=>$settings, "latestProperties"=>$latestProperties, "latestProjects"=>$latestProjects];

        // Get search background image, if show_Search is true:
        if($settings["show_search"] == true)
        {
            $templateArgs["search_background"] = $systemMediaRepository->getSettings("search_background");
        }

        // Passes parameters to home template:    
        return view('home', $templateArgs);
    }

}
