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
use App\Repositories\PropertyExteriorFeatureRepository;
use App\Repositories\PropertyViewRepository;
use App\Repositories\PropertyMediaRepository;

use App\Repositories\SystemDefaultsRepository;

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
                        PropertyInteriorFeatureRepository $propertyInteriorFeatureRepository,
                        PropertyExteriorFeatureRepository $propertyExteriorFeatureRepository,
                        PropertyViewRepository $propertyViewRepository,
                        PropertyMediaRepository $propertyMediaRepository)
    {

        $validatedData = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:property,slug',
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
        $images = $request->images;
            $imageIds = (array) explode(",",$images);     
        $exteriorFeatures = $request->exterior_features;
            $exteriorFeatureIds = (array) explode(",",$exteriorFeatures);
        $view = $request->view;
            $viewIds = (array) explode(",",$view); 
        $hasGarden = (boolean) $request->has_garden;
        $gardenArea = $request->garden_area;
        $hasParkSpace = (boolean) $request->has_park_space;
        $numberOfParkSpaces = $request->number_of_park_spaces;
        $images = $request->images;
        $estate_location = $request->estate_location;

        $lat = $request->lat;
        $lon = $request->lon;

        $featuredImage = $request->featured_image;

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
            'created_by'=>$userId,
            "lat"=>$lat,
            "lon"=>$lon
        ];

        $newProperty = $propertyRepository->create($propertyObject);
        $propertyId = $newProperty->id;

        // Save interior features:
        if(sizeof($interiorFeatureIds) > 0){
            foreach($interiorFeatureIds AS $interiorFeatureId){
                $propertyInteriorFeatureRepository->create(['property'=>$propertyId, 'interior_feature'=>$interiorFeatureId]);
            }
        }

        // Save exterior features:
        if(sizeof($exteriorFeatureIds) > 0){
            foreach($exteriorFeatureIds AS $exteriorFeatureId){
                $propertyExteriorFeatureRepository->create(['property'=>$propertyId, 'exterior_feature'=>$exteriorFeatureId]);
            }
        }

        // Save view:
        if(sizeof($viewIds) > 0){
            foreach($viewIds AS $viewId){
                $propertyViewRepository->create(['property'=>$propertyId, 'view'=>$viewId]);
            }
        }

        // Save images:
        if(sizeof($imageIds) > 0){
            foreach($imageIds AS $imageId){
                $propertyMediaRepository->create(['property'=>$propertyId, 'media'=>$imageId]);
            }
        }

        // Set featured image id:
        $propertyRepository->update(['featured_image'=>$featuredImage], $propertyId);

    }        

    /**
     * Single property page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function single(Request $request,
                                PropertyRepository $propertyRepository,
                                PropertyMediaRepository $propertyMediaRepository,
                                ExteriorFeatureRepository $exteriorFeatureRepository,
                                InteriorFeatureRepository $interiorFeatureRepository,
                                ViewRepository $viewRepository,
                                SystemDefaultsRepository $systemDefaultsRepository
                            )
    {

        $slug = $request->slug;

        $propertyId = $propertyRepository->getPropertyIdBySlug($slug);

        $property = $propertyRepository->getSingleBySlug($propertyId);
        $propertyImages = $propertyMediaRepository->getPropertyMedia($propertyId);

        $interiorFeatures = $interiorFeatureRepository->getPropertyFeatures($propertyId);
        $exteriorFeatures = $exteriorFeatureRepository->getPropertyFeatures($propertyId);
        $views            = $viewRepository->getPropertyViews($propertyId);

        $defaultMeasurementUnit = $systemDefaultsRepository->getSetting("default_measurement_unit");
        $defaultMoneyUnit = $systemDefaultsRepository->getSetting("default_money_unit");

        $singleOptions = [
            "property"=>$property,
            "propertyImages"=>$propertyImages,
            "interiorFeatures"=>$interiorFeatures,
            "exteriorFeatures"=>$exteriorFeatures,
            "views"=>$views,
            "measurementUnit"=>$defaultMeasurementUnit,
            "moneyUnit"=>$defaultMoneyUnit
        ];

        return view('property.single', $singleOptions);

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
