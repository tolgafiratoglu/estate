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
    protected $table = 'property_exterior_feature';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['property', 'exterior_feature'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exteriorFeature()
    {
        return $this->belongsTo('App\ExteriorFeature', 'exterior_feature');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function property()
    {
        return $this->belongsTo('App\Property', 'property');
    }
}
