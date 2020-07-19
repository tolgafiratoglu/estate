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
use App\Repositories\LocationRepository;

use App\Repositories\PropertyInteriorFeatureRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{

    /**
     * Save property
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function save(Request $request, 
                        PropertyRepository $propertyRepository,
                        PropertyInteriorFeatureRepository $propertyInteriorFeatureRepository)
    {

        $validatedData = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'location'=> 'required'
        ]);

        $title = $validatedData['title'];
        $slug  = $validatedData['slug'];

        $userId = Auth::user()->id;

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
            $interiorFeatureIds = (array) explode(",",$interiorFeatures); 
        $exteriorFeatures = $request->exterior_features;
            $exteriorFeatureIds = (array) explode(",",$exteriorFeatures); 
        $hasGarden = (boolean) $request->has_garden;
        $gardenArea = $request->garden_area;
        $hasParkSpace = (boolean) $request->has_park_space;
        $numberOfParkSpaces = $request->number_of_park_spaces;
        $images = $request->images;
        $estate_location = $request->estate_location;

        $propertyObject = [
            'title'=>$title,
            'slug'=>$slug,
            'property_type'=>$propertyType,
            'property_status'=>$propertyStatus,
            'description'=>$description,
            'price'=>$price,
            'area'=>$area,
            'year_built'=>$yearBuilt,
            'number_of_rooms'=>$numberOfRooms,
            'number_of_bathrooms'=>$numberOfBathrooms,
            'number_of_floors'=>$numberOfFloors,
            'which_floor'=>$whichFloor,
            'has_garden'=>$hasGarden,
            'has_park_space'=>$hasParkSpace,
            'location'=>$estate_location,
            'created_by'=>$userId
        ];

        $newProperty = $propertyRepository->create($propertyObject);
        $propertyId = $newProperty->id;

        if(sizeof($interiorFeatureIds) > 0){
            foreach($interiorFeatureIds AS $interiorFeatureId){
                $propertyInteriorFeatureRepository->create(['property'=>$propertyId, 'interior_feature'=>$interiorFeatureId]);
            }
        }

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
                        InteriorFeatureRepository $interiorFeatureRepository,
                        LocationRepository $locationRepository)
    {

        $propertyTypes   = $propertyTypeRepository->all();
        $propertyStatus = $propertyStatusRepository->all();

        $heatingOptions = $heatingRepository->all();
        $coolingOptions = $coolingRepository->all();
        $viewOptions    = $viewRepository->all();

        $exteriorFeatureOptions = $exteriorFeatureRepository->all();
        $interiorFeatureOptions = $interiorFeatureRepository->all();

        $locations = $locationRepository->findWhere(["parent"=>NULL]);

        $newPropertyOptions = [
            'propertyTypes'   => $propertyTypes, 
            'propertyStatus'  => $propertyStatus,
            'heatingOptions'  => $heatingOptions,
            'coolingOptions'  => $coolingOptions,
            'viewOptions'     => $viewOptions,
            'exteriorFeatureOptions' => $exteriorFeatureOptions,
            'interiorFeatureOptions' => $interiorFeatureOptions,
            'locations'  => $locations
        ];

        return view('property.new', $newPropertyOptions);
    }

}
