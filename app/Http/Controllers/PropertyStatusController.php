<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\PropertyStatusRepository;

class PropertyStatusController extends Controller
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
     * Lists admin propert status:
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminList(Request $request, PropertyStatusRepository $propertyStatusRepository)
    {

        $offset   = $request->offset ? $request->offset : NULL;
        $limit    = $request->limit ? $request->limit: NULL;
        $deleted  = $request->deleted ? $request->deleted : false;

        $propertyStatusList = $propertyStatusRepository->getStatusList($deleted, 0, 10);

        return view('admin.property_status')->with(['adminPropertyStatusList'=>$propertyStatusList, 'module'=>'property_status']);
    }

    /**
     * Public api method to return enabled locations:
     *
     * @return \Symfony\Component\HttpFoundation\Response 
     */
    public function getPropertyStatus(Request $request, PropertyStatusRepository $propertyStatusRepository)
    {

        $offset   = $request->start ? $request->start : NULL;
        $limit    = $request->length ? $request->length: NULL;
        $deleted  = $request->deleted ? $request->deleted : false;

        $propertyStatusList = $propertyStatusRepository->getStatusList($deleted, $offset, $limit);

        $propertyStatusList = ["data"=>$propertyStatusList];

        return response()->json($propertyStatusList);

    }

}
