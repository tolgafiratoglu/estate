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
        $offset   = $request->offset ? $request->offset : 0;
        $limit    = $request->limit ? $request->limit : 0;

        $propertyStatusList  = $propertyStatusRepository->getStatusList($deleted, $offset, $limit);
        $propertyStatusCount = $propertyStatusRepository->getStatusListCount($deleted);

        return view('admin.property_status')->with(['deleted'=>$deleted, 'module'=>'property_status', 'data'=>$propertyStatusList, 'total_data_count'=>$propertyStatusCount]);
    
    }

    /**
     * Edit property status
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editPropertyStatus(Request $request, PropertyStatusRepository $propertyStatusRepository)
    {

        $itemId  = $request->id ? $request->id : NULL;

        $data = NULL;
        if($itemId > 0) {
            $data = $propertyStatusRepository->getPropertyStatus($itemId);
        }

        return view('admin.property_status_save')->with(["data"=>$data, 'module'=>'property_status']);
        
    }

    /**
     * New property status
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newPropertyStatus(Request $request, PropertyStatusRepository $propertyStatusRepository)
    {

        return view('admin.property_status_save')->with(['module'=>'property_status']);
    
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

    /*
    * Save property status 
    * @return \Symfony\Component\HttpFoundation\Response 
    */
    public function savePropertyStatus(Request $request, PropertyStatusRepository $propertyStatusRepository){

        $name = $request->name ? $request->name : '';
        $slug = $request->slug ? $request->slug : '';

        $slugExists = $propertyStatusRepository->slugExists($slug);
        $nameExists = $propertyStatusRepository->nameExists($slug);

        if($nameExists > 0){
            return response(__('admin.property_status_name_exists'), 400)->header('Content-Type', 'text/plain');
        }

        if($slugExists > 0){
            return response(__('admin.property_status_slug_exists'), 400)->header('Content-Type', 'text/plain');
        }

        $propertyStatus = $propertyStatusRepository->savePropertyStatus($name, $slug);

        return response()->json($propertyStatus);
    
    }


}
