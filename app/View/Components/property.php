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

    /*
    * Rows
    * $var integer
    */
    public $rows;

    /**
     * Create a new component instance.
     *
     * @param  array  $property
     * @return void
     */
    public function __construct($property, $rows)
    {
        $this->property = $property;
        $this->rows = $rows;
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
