<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'menu';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = [
        'context', 'label', 'target', 'custom_url', 'parent', 'property', 'blog'
    ];

}
