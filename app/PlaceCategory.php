<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property PlaceCategory $place_category
 * @property double $lat
 * @property double $lon
 * @property string $title
 * @property propertyPlaces[] $propertyPlaces
 */
class PlaceCategory extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'place_category';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['created_at', 'updated_at', 'title', 'place_category', 'lat', 'lon'];

}
