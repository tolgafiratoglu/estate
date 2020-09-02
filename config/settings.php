<?php

    return [

        'system_settings' => [
            'approval_needed_for_new_property' => true,
            'main_page_show_search' => true,
            'main_page_show_latest_properties' => true,
            'main_page_show_latest_projects' => true,
            'main_page_show_latest_blogs' => true
        ], 

        'system_limits' => [
            'user_max_daily_new_property' => 10,
            'agent_max_daily_new_property' => 10
        ], 

        'system_defaults' => [
            'default_measurement_unit' => 'meter',
            'default_money_unit' => 'usd',
            'home_page_title' => 'Home Page',
            'search_page_title' => 'Search Page',
        ],

        'system_media' => [
            'header_logo' => null,
            'footer_logo' => null,
            'search_background' => null
        ],

    ];