<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $property
 * @property integer $exterior_feature
 * @property ExteriorFeature $exteriorFeature
 * @property Property $property
 */
class PropertyExteriorFeature extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'property_place';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['property', 'place'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place()
    {
        return $this->belongsTo('App\Place', 'place');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function property()
    {
        return $this->belongsTo('App\Property', 'property');
    }
}
