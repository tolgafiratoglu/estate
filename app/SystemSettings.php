<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $meta_key
 * @property boolean $meta_value
 */
class SystemSettings extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['meta_key', 'meta_value'];

}
