<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PropertyController extends Controller
{

    /**
     * New property
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function new()
    {
        return view('property.new');
    }

}
