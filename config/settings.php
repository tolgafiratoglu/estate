<?php

    return [

        'system_settings' => [
            'property_save' => [
                'approval_needed' => true,
            ],
            'main' => [
                'show_search' => true,
                'show_latest_properties' => true,
                'show_latest_projects' => true,
                'show_latest_blogs' => true
            ],
            'header' => [
                'show_upper_header'=>true,
                'show_logo' => true,
                'show_upload_button' => true,
                'show_menu' => true,
                'show_authentication' => true,
                'show_social_media_icons' => true
            ],
            'filter' => [
                'show_location' => true,
                'show_property_type' => true,
                'show_property_status' => true,
                'show_price_range' => true,
                'show_area_range' => true,
                'show_indoor_features' => true,
                'show_outdoor_features' => true,
                'show_number_of_rooms' => true,
                'show_bathroom_selector' => true,
                'show_address' => true,
                'show_floor_range' => true,
                'show_park_area_selector' => true,
                'show_garden_selector' => true,
                'show_keyword' => true,
                'show_age_of_building' => true,
            ]
        ], 

        'system_limits' => [
            'property'=>[
                'user_max_daily_new_property' => ['initial'=>10, 'range_min'=>1, 'range_max'=>100],
                'agent_max_daily_new_property' => ['initial'=>10, 'range_min'=>1, 'range_max'=>100]
            ]
        ], 

        'system_defaults' => [
            'units'=>[
                'default_measurement_unit' => 'meter',
                'default_money_unit' => 'USD',
            ],
            'meta'=>[
                'home_page_title' => 'Home Page',
                'search_page_title' => 'Search Page',
            ],
            'social_media'=>[
                'facebook'=>'#',
                'google'=>'#',
                'twitter'=>'#',
                'linkedin'=>'#'
            ],
            'header'=>[
                'email'=>'info@yourdomain.com'
            ]
        ],

        'system_media' => [
            'header_logo' => null,
            'footer_logo' => null,
            'search_background' => null
        ],

    ];