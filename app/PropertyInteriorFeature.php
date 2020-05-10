<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $property
 * @property integer $interior_feature
 * @property InteriorFeature $interiorFeature
 * @property Property $property
 */
class PropertyInteriorFeature extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'property_interior_feature';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['property', 'interior_feature'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function interiorFeature()
    {
        return $this->belongsTo('App\InteriorFeature', 'interior_feature');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function property()
    {
        return $this->belongsTo('App\Property', 'property');
    }
}
