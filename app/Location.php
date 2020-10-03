<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property Property[] $properties
 */
class Location extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'location';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['created_at', 'updated_at', 'name', 'slug', 'description', 'is_deleted', 'parent'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function properties()
    {
        return $this->hasMany('App\Property', 'location');
    }
}
