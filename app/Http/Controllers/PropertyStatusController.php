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
        $deleted  = $request->deleted ? $request->deleted : 0;
        return view('admin.property_status')->with(['deleted'=>$deleted, 'module'=>'property_status']);
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
        $deleted  = $request->deleted ? $request->deleted : 0;

        $propertyStatusList  = $propertyStatusRepository->getStatusList($deleted, $offset, $limit);
        $propertyStatusCount = $propertyStatusRepository->getStatusListCount($deleted);

        $propertyStatusList = ["data"=>$propertyStatusList, "recordsTotal"=>$propertyStatusCount, "recordsFiltered"=>sizeof($propertyStatusList)];

        return response()->json($propertyStatusList);

    }

}
