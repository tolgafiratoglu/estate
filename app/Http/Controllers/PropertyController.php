<?php

namespace App\Http\Controllers;

use App\Repositories\PropertyRepository;
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
     * Save property
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function save(Request $request, PropertyRepository $propertyRepository)
    {

        $validatedData = $request->validate([
            'title' => 'required',
            'slug' => 'required'
        ]);

        var_dump($validatedData);

        $title = $validatedData['title'];
        $slug  = $validatedData['slug'];

        $propertyType = $request->property_type;
        $propertyStatus = $request->property_status;
        $description = $request->description;
        $price = $request->price;
        $area = $request->area;
        $yearBuilt = $request->year_built;
        $numberOfRooms = $request->number_of_rooms;
        $numberOfBathrooms = $request->number_of_bathrooms;
        $numberOfFloors = $request->number_of_floors;
        $whichFloor = $request->which_floor;
        $interiorFeatures = $request->interior_features;
        $exteriorFeatures = $request->exterior_features;
        $hasGarden = $request->has_garden;
        $gardenArea = $request->garden_area;
        $hasParkSpace = $request->has_park_space;
        $numberOfParkSpaces = $request->number_of_park_spaces;

        $propertyObject = [
            'title'=>$title,
            'slug'=>$slug,
            'property_type'=>$propertyType,
            'property_status'=>$propertyStatus,
            'description'=>$description,
            'price'=>$price,
            'area'=>$area,
            'year_built'=>$yearBuilt,
            
        ];

        $propertyRepository->create($propertyObject);

    }        

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
