<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $meta_key
 * @property int $meta_value
 */
class SystemLimits extends Model
{

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['context', 'meta_key', 'meta_value'];

}
