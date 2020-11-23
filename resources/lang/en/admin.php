<?php

    return [
        'name'=>'Name',
        'slug'=>'Slug',
        'edit'=>'Edit',
        'delete'=>'Delete',
        'remove'=>'Remove',
        'restore'=>'Restore',
        'system_error'=>'There was a system error, please try again later.',
        'should_not_be_empty'=>'Should not be empty',
        'optional'=>'Optional',
        'confirm_action' => 'Confirm Action',
        'confirm_delete_action_detail' => 'Do you really want to delete this item?',
        'confirm_remove_action_detail' => 'Do you really want to remove this item from the database?',
        'confirm_restore_action_detail' => 'Do you really want to restore this item?',
        'confirm_action_yes' => 'Yes',
        'confirm_action_close' => 'Cancel',
        'property_status'=> 'Property Status',
        'property_status_detail'=> 'Property status title (For Rent, For Sale, etc)',
        'property_status_slug'=> 'Property Status Slug',
        'property_status_slug_detail'=> 'URL of the property status, should be unique',
        'property_status_name_exists'=> 'Name exists, it should be unique',
        'property_status_name_not_blank'=> "Name shouldn't be blank",
        'property_status_slug_exists'=> 'Slug exists, it should be unique',
        'button'=>[
            'save'=>'Save'
        ],
        'settings'=>[
            'context'=>[
                'property_save'=>'Property Settings',
                'main'=>'Main Page Settings',
                'header'=>'Header Settings',
                'filter'=>'Filter Settings'
            ],
            'meta'=>[
                'property_save'=>[
                    'approval_required'=>'Admin approval required for adding a property',
                ],
                'main'=>[
                    'show_search'=>'Show search on main page',
                    'show_latest_properties'=>'Show latest properties on main page',
                    'show_latest_projects'=>'Show latest projects on main page',
                    'show_latest_blogs'=>'Show latest projects on main page',
                ],
                'header'=>[
                    'show_upper_header'=>'Show upper side of header',
                    'show_logo'=>'Show logo on header',
                    'show_upload_button'=>'Show upload button to add a listing',
                    'show_menu'=>'Show menu on header',
                    'show_authentication'=>'Show authentication on header',
                    'show_social_media_icons'=>'Show social media icons on header',
                ],
                'filter'=>[
                    'show_location'=>'Show location filter',
                    'show_property_type'=>'Show property type filter',
                    'show_property_status'=>'Show property status',
                    'show_price_range'=>'Show price range filter',
                    'show_area_range'=>'Show area range filter',
                    'show_indoor_features'=>'Show indoor features filter',
                    'show_outdoor_features'=>'Show outdoor features filter',
                    'show_number_of_rooms'=>'Show number of rooms filter',
                    'show_bathroom_selector'=>'Show bathroom filter',
                    'show_address'=>'Show address filter',
                    'show_park_area_selector'=>'Show park area filter',
                    'show_garden_selector'=>'Show garden filter',
                    'show_keyword'=>'Show keyword filter',
                    'show_age_of_building'=>'Show age of building filter'
                ]
            ]    
        ],
        'defaults'=>[
            'context'=>[
                'units'=>[
                    'header'=>'Unit Settings',
                    'default_measurement_unit'=>'Measure',
                    'default_currency_unit'=>'Currency'
                ],
                'meta'=>[
                    'header'=>'Meta Settings',
                    'home_page_title'=>'Home Page Title',
                    'search_page_title'=>'Search Page Title'
                ],
                'social_media'=>[
                    'header'=>'Social Media Settings',
                    'facebook'=>'Facebook Page',
                    'twitter'=>'Twitter Page',
                    'linkedin'=>'Linkedin'
                ]
            ]
        ]
    ];