<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $title
 * @property propertyPlaces[] $propertyPlaces
 */
class ExteriorFeature extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'exterior_feature';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['created_at', 'updated_at', 'title'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function propertyExteriorFeatures()
    {
        return $this->hasMany('App\ExteriorFeature', 'exterior_feature');
    }
}
