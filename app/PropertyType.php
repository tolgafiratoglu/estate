<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property string $slug
 * @property Property[] $properties
 */
class PropertyType extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'property_type';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['created_at', 'updated_at', 'title', 'slug'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function properties()
    {
        return $this->hasMany('App\Property', 'property_type');
    }
}
