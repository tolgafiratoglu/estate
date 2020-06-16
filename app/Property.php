<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
 * @property boolean is_approved
 * @property boolean is_drafted
 * @property boolean is_deleted
 */
class Property extends Model
{
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
    protected $fillable = ['created_at', 'updated_at', 'location', 'created_by', 'property_status',	'type',	'featured_image', 'price', 'address', 'area', 'age_of_building', 'number_of_living_rooms', 'number_of_rooms', 'number_of_bathrooms', 'floor', 'lat', 'lon', 'is_approved', 'is_drafted', 'is_deleted'];

}