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
    public function listPropertyStatus(Request $request, PropertyStatusRepository $propertyStatusRepository) {

        $deleted  = $request->deleted ? $request->deleted : 0;
        $page     = $request->page ? $request->page : 1;

        $limit    = 10;
        $offset   = ($page - 1)*$limit;

        $propertyStatusList  = $propertyStatusRepository->getStatusList($deleted, $offset, $limit);
        $propertyStatusCount = $propertyStatusRepository->getStatusListCount($deleted);

        return view('admin.property_status')->with(['deleted'=>$deleted, 'module'=>'property_status', 'page'=>$page, 'data'=>$propertyStatusList, 'total_data_count'=>$propertyStatusCount]);
    
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

        return view('admin.property_status_save')->with(["new"=>false,"data"=>$data, 'module'=>'property_status']);
        
    }

    /**
     * New property status
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newPropertyStatus(Request $request, PropertyStatusRepository $propertyStatusRepository)
    {

        return view('admin.property_status_save')->with(["new"=>true, "data"=>[], 'module'=>'property_status']);
    
    }

    /**
     * Public api method to return property status
     *
     * @return \Symfony\Component\HttpFoundation\Response 
     */
    public function getPropertyStatus(Request $request, PropertyStatusRepository $propertyStatusRepository)
    {

        $offset   = $request->start ? $request->start : NULL;
        $limit    = $request->length ? $request->length: NULL;
        $deleted  = $request->deleted ? $request->deleted : 0;

        $propertyStatusList  = $propertyStatusRepository->getStatusList($deleted, $offset, $limit);

        $propertyStatusListResponse = [];

        if(sizeof($propertyStatusList)){
            foreach($propertyStatusList AS $propertyStatus){
                $editButton = '<span class="admin-list-control-buttons admin-list-edit" data-id="'.$propertyStatus["id"].'"><a href="/admin/property-status/edit/'.$propertyStatus["id"].'"><i class="far fa-edit"></i><span class="admin-list-control-label">'.__("admin.edit").'</span></a></span>';
                $deleteButton = '<span data-toggle="modal" data-target="#delete_confirm" class="admin-list-control-buttons admin-list-delete" data-id="'.$propertyStatus["id"].'"><i class="far fa-trash-alt"></i><span class="admin-list-control-label">'.__("admin.delete").'</span></span>';
                $propertyStatus["buttons"] = $editButton.$deleteButton;
                $propertyStatusListResponse[] = $propertyStatus;
            }
        }

        $propertyStatusCount = $propertyStatusRepository->getStatusListCount($deleted);

        $propertyStatusList = ["data"=>$propertyStatusListResponse, "recordsTotal"=>$propertyStatusCount, "recordsFiltered"=>sizeof($propertyStatusList)];

        return response()->json($propertyStatusList);

    }

    public function deletePropertyStatus(Request $request, PropertyStatusRepository $propertyStatusRepository){

        $validatedData = $request->validate([
            'item_id' => 'required'
        ]);

    }

    /*
    * Save property status 
    * @return \Symfony\Component\HttpFoundation\Response 
    */
    public function savePropertyStatus(Request $request, PropertyStatusRepository $propertyStatusRepository)
    {

        $id   = $request->id ? $request->id : NULL;
        
        $validationRules = [
            'name' => 'unique:property_status,name',
            'slug' => 'required|unique:property_status,slug'
        ];

        if($id > 0) {
            $validationRules = [
                'name' => 'unique:property_status,name,'.$id,
                'slug' => 'required|unique:property_status,slug,'.$id
            ];
        }

        $validatedData = $request->validate($validationRules);

        $name = $validatedData["name"];
        $slug = $validatedData["slug"];

        if($id > 0) {
            $propertyStatus = $propertyStatusRepository->updatePropertyStatus($id, $name, $slug);
        }else{    
            $propertyStatus = $propertyStatusRepository->savePropertyStatus($name, $slug);
        }

        return response()->json($propertyStatus);
    
    }


}
