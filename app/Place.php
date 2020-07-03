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
class Place extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'place';

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
    public function propertyPlaces()
    {
        return $this->hasMany('App\PropertyPlace', 'place');
    }
}
