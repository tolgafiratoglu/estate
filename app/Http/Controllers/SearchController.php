<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\LocationRepository;
use App\Repositories\PropertyTypeRepository;
use App\Repositories\PropertyStatusRepository;
use App\Repositories\InteriorFeatureRepository;
use App\Repositories\ExteriorFeatureRepository;

class SearchController extends Controller
{

    /**
     * Panel to search properties
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(LocationRepository $locationRepository, PropertyTypeRepository $propertyTypeRepository, PropertyStatusRepository $propertyStatusRepository, InteriorFeatureRepository $interiorFeatureRepository, ExteriorFeatureRepository $exteriorFeatureRepository)
    {

        // Get locations:
        $locations = $locationRepository->getLocations(true, false, 0);

        // Get property types:
        $propertyTypes = $propertyTypeRepository->getPropertyTypes(false);

        // Get property status:
        $propertyStatus = $propertyStatusRepository->getStatusList(false);

        // Get interior features:
        $interiorFeatures = $interiorFeatureRepository->getInteriorFeatureList(false);

        // Get exterior features:
        $exteriorFeatures = $exteriorFeatureRepository->getExteriorFeatureList(false);

        return view('search')->with(["locations"=>$locations, "propertyTypes"=> $propertyTypes, "propertyStatus"=>$propertyStatus]);
    }

}
