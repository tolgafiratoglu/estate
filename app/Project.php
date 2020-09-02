<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $location
 * @property integer $created_by
 * @property integer $featured_image
 * @property string $created_at
 * @property string $updated_at
 * @property string $title
 * @property string $slug
 * @property string $estimated_completion_date
 * @property boolean $on_sale
 * @property string $estimated_date_for_sale
 * @property int $number_of_properties
 * @property int $min_number_of_rooms
 * @property int $max_number_of_rooms
 * @property float $min_price
 * @property float $max_price
 * @property float $lat
 * @property float $lon
 * @property boolean $approval_status
 * @property boolean $is_drafted
 * @property boolean $is_deleted
 * @property User $user
 * @property Medium $medium
 * @property Location $location
 */
class Project extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'project';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['location', 'created_by', 'featured_image', 'created_at', 'updated_at', 'title', 'slug', 'estimated_completion_date', 'on_sale', 'estimated_date_for_sale', 'number_of_properties', 'min_number_of_rooms', 'max_number_of_rooms', 'min_price', 'max_price', 'lat', 'lon', 'approval_status', 'is_drafted', 'is_deleted'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medium()
    {
        return $this->belongsTo('App\Medium', 'featured_image');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo('App\Location', 'location');
    }
}
