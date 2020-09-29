<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;


/**
 * @property integer $id
 * @property string created_at
 * @property string updated_at 
 * @property string location 
 * @property integer created_by
 * @property integer property_status
 * @property integer type
 * @property integer featured_image
 * @property decimal price
 * @property string address
 * @property integer area
 * @property integer age_of_building
 * @property integer number_of_living_rooms
 * @property integer number_of_rooms
 * @property integer number_of_bathrooms
 * @property integer floor
 * @property decimal lat
 * @property decimal lon
 * @property boolean is_drafted
 * @property boolean is_deleted
 */
class Property extends Model
{

    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'property';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['created_at', 
                            'updated_at', 
                            'title',
                            'slug',
                            'description',
                            'location', 
                            'created_by', 
                            'property_status',	
                            'property_type',	
                            'featured_image',
                            'heating',
                            'cooling',
                            'price', 
                            'address', 
                            'area', 
                            'year_built', 
                            // 'number_of_living_rooms', 
                            'number_of_rooms', 
                            'number_of_bathrooms', 
                            'number_of_floors',
                            'which_floor',
                            'has_garden',
                            'area_of_garden',
                            'has_park_area',
                            'number_of_park_areas',
                            'lat', 
                            'lon', 
                            'approval_status',
                            // 'is_approved', 
                            'is_drafted', 
                            'is_deleted',
                            'is_custom_info',
                            'custom_info_name',
                            'custom_info_phone',
                            'custom_info_email'
                        ];

}
