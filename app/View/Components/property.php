<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Property extends Component
{

    /*
    * Property
    *
    * @var array
    */
    public $property;

    /**
     * Create a new component instance.
     *
     * @param  array  $property
     * @return void
     */
    public function __construct($property)
    {
        $this->property = $property;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.property');
    }
}
