<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $meta_key
 * @property string $meta_value
 */
class SystemDefaults extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['meta_key', 'meta_value'];

}
