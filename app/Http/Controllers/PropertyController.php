<?php

namespace App\Http\Controllers;

use App\Repositories\PropertyStatusRepository;
use App\Repositories\PropertyTypeRepository;

use Illuminate\Http\Request;

class PropertyController extends Controller
{

    /**
     * New property
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function new(PropertyStatusRepository $propertyStatusRepository, PropertyTypeRepository $propertyTypeRepository)
    {

        $propertyTypes   = $propertyTypeRepository->all();
        $propertyStatus = $propertyStatusRepository->all();

        return view('property.new', ['propertyTypes'=>$propertyTypes, 'propertyStatus'=>$propertyStatus]);
    }

}
