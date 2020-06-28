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

        $propertyTypes   = $propertyTypeRepository->findWhere(['is_deleted'=>false], ['id', 'name']);
        $propertyStatus = $propertyStatusRepository->findWhere(['is_deleted'=>false], ['id', 'name']);

        return view('property.new', ['propertyTypes'=>$propertyTypes, 'propertyStatus'=>$propertyStatus]);
    }

}
