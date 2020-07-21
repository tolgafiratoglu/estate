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
    public function index(LocationRepository $locationRepository, 
                            PropertyTypeRepository $propertyTypeRepository, 
                            PropertyStatusRepository $propertyStatusRepository, 
                            InteriorFeatureRepository $interiorFeatureRepository, 
                            ExteriorFeatureRepository $exteriorFeatureRepository, 
                            PropertyRepository $propertyRepository)
    {

        // Get locations:
        $locations = $locationRepository->getLocations(true, false, NULL);

        // Get property types:
        $propertyTypes = $propertyTypeRepository->getPropertyTypes(false);

        // Get property status:
        $propertyStatus = $propertyStatusRepository->all();

        // Get interior features:
        $interiorFeatures = $interiorFeatureRepository->all();

        // Get exterior features:
        $exteriorFeatures = $exteriorFeatureRepository->all();

        $propertyStats = [];

        // Min-max values:
        $propertyStats["max_area"]  = $propertyRepository->getMaxValue('area');
        $propertyStats["min_price"] = $propertyRepository->getMinValue('price');
        $propertyStats["max_price"] = $propertyRepository->getMaxValue('price');
        $propertyStats["max_number_of_rooms"] = $propertyRepository->getMaxValue('number_of_rooms');
        $propertyStats["min_floor"] = $propertyRepository->getMinValue('number_of_floors');
        $propertyStats["max_floor"] = $propertyRepository->getMaxValue('number_of_floors');
        $propertyStats["max_age_of_building"] = date("Y") - $propertyRepository->getMinValue('year_built');
        $propertyStats["min_age_of_building"] = date("Y") - $propertyRepository->getMaxValue('year_built');

        // Get properties for the initial property list view:
        $initialProperties = $propertyRepository->getPropertyList(false, true, false, 0, 12, 'id', 'DESC');

        return view('search')->with(["locations"=>$locations, "propertyTypes"=> $propertyTypes, "propertyStatus"=>$propertyStatus, "interiorFeatures"=>$interiorFeatures, "exteriorFeatures"=>$exteriorFeatures, "propertyStats"=>$propertyStats, "initialProperties"=>$initialProperties]);
    }

}
