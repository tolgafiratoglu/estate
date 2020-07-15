<?php

namespace App\Http\Controllers;

use App\Repositories\PropertyStatusRepository;
use App\Repositories\PropertyTypeRepository;
use App\Repositories\HeatingRepository;
use App\Repositories\CoolingRepository;
use App\Repositories\ViewRepository;
use App\Repositories\ExteriorFeatureRepository;
use App\Repositories\InteriorFeatureRepository;

use Illuminate\Http\Request;

class PropertyController extends Controller
{

    /**
     * New property
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function new(PropertyStatusRepository $propertyStatusRepository, 
                        PropertyTypeRepository $propertyTypeRepository,
                        HeatingRepository $heatingRepository,
                        CoolingRepository $coolingRepository,
                        ViewRepository $viewRepository,
                        ExteriorFeatureRepository $exteriorFeatureRepository,
                        InteriorFeatureRepository $interiorFeatureRepository)
    {

        $propertyTypes   = $propertyTypeRepository->all();
        $propertyStatus = $propertyStatusRepository->all();

        $heatingOptions = $heatingRepository->all();
        $coolingOptions = $coolingRepository->all();
        $viewOptions    = $viewRepository->all();

        $exteriorFeatureOptions = $exteriorFeatureRepository->all();
        $interiorFeatureOptions = $interiorFeatureRepository->all();

        $newPropertyOptions = [
            'propertyTypes'   => $propertyTypes, 
            'propertyStatus'  => $propertyStatus,
            'heatingOptions'  => $heatingOptions,
            'coolingOptions'  => $coolingOptions,
            'viewOptions'     => $viewOptions,
            'exteriorFeatureOptions' => $exteriorFeatureOptions,
            'interiorFeatureOptions' => $interiorFeatureOptions 
        ];

        return view('property.new', $newPropertyOptions);
    }

}
