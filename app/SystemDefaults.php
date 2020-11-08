<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $meta_key
 * @property string $meta_value
 */
class SystemDefaults extends Model
{

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['id', 'context', 'meta_key', 'meta_value'];

}
