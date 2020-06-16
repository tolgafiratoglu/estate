<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\PropertyRepository;
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
    public function index(LocationRepository $locationRepository, PropertyTypeRepository $propertyTypeRepository, PropertyStatusRepository $propertyStatusRepository, InteriorFeatureRepository $interiorFeatureRepository, ExteriorFeatureRepository $exteriorFeatureRepository, PropertyRepository $propertyRepository)
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

        $propertyStats = [];

        // Min-max values:
        $propertyStats["max_area"]  = $propertyRepository->getMax('area');
        $propertyStats["min_price"] = $propertyRepository->getMin('price');
        $propertyStats["max_price"] = $propertyRepository->getMax('price');
        $propertyStats["max_number_of_rooms"] = $propertyRepository->getMax('number_of_rooms');
        $propertyStats["min_floor"] = $propertyRepository->getMin('floor');
        $propertyStats["max_floor"] = $propertyRepository->getMax('floor');
        $propertyStats["min_age_of_building"] = $propertyRepository->getMin('age_of_building');
        $propertyStats["max_age_of_building"] = $propertyRepository->getMax('age_of_building');

        var_dump($propertyStats);

        return view('search')->with(["locations"=>$locations, "propertyTypes"=> $propertyTypes, "propertyStatus"=>$propertyStatus, "interiorFeatures"=>$interiorFeatures, "exteriorFeatures"=>$exteriorFeatures, "propertyStats"=>$propertyStats]);
    }

}
