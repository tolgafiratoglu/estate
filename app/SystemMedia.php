<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemMedia extends Model
{
    
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['meta_key', 'media'];

}
