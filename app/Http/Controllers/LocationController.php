<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\LocationRepository;

class LocationController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    
    /**
     * Public api method to return enabled locations:
     *
     * @return \Symfony\Component\HttpFoundation\Response 
     */
    public function getLocations(Request $request, LocationRepository $locationRepository)
    {
        $offset   = $request->offset ? $request->offset : NULL;
        $limit    = $request->limit ? $request->limit: NULL;
        $parentId = $request->parent_id ? $request->parent_id : NULL;
        $keyword  = $request->keyword ? $request->keyword : NULL;  

        $locations = $locationRepository->getLocations(true, false, $parentId, $offset, $limit);

        return response()->json($locations);

    }

    /**
     * Public api method to return child locations
     *
     * @return \Symfony\Component\HttpFoundation\Response 
     */
    public function getChildLocations(Request $request, LocationRepository $locationRepository)
    {

        $validatedData = $this->validate($request, ['parent_id' => 'required',]);
        $parentId = $validatedData["parent_id"];

        $childLocations = $locationRepository->findWhere(["parent"=>$parentId], ["id", "name", "slug"]);

        return response()->json($childLocations);

    }

}
