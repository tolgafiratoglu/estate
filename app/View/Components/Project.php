<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Project extends Component
{
    /*
    * Project
    *
    * @var array
    */
    public $project;

    /*
    * Rows
    * $var integer
    */
    public $rows;

    /**
     * Create a new component instance.
     *
     * @param  array  $project
     * @return void
     */
    public function __construct($project, $rows)
    {
        $this->project = $project;
        $this->rows = $rows;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.project');
    }
}
