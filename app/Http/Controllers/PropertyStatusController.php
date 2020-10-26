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
     * Outputs list view
     * 
     * @param integer $deleted Switches list into a trash bin when it's 1, otherwise it's a normal list of active items.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function listPropertyStatus(Request $request, PropertyStatusRepository $propertyStatusRepository) {

        $deleted  = $request->deleted ? $request->deleted : 0;

        return view('admin.property_status')->with(['deleted'=>$deleted, 'module'=>'property_status']);
    
    }

    /**
     * Outputs edit form to update the item with a given id
     * 
     * @param $id Id of the item to be edited
     * 
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
     * Outputs new item form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newPropertyStatus(Request $request, PropertyStatusRepository $propertyStatusRepository)
    {
        return view('admin.property_status_save')->with(["new"=>true, "data"=>[], 'module'=>'property_status']);
    }

    /**
     * Private api method to return property status
     * 
     * @param $start   Offset of the retrieved items
     * @param $length  Limit of the retrieved items
     * @param $deleted Filter items by if they are deleted or not
     * @param $order   Order of the retrieved items
     * @param $search  Keyword to search in the data
     * @param $columns Table column metadata
     *
     * @return \Symfony\Component\HttpFoundation\Response 
     */
    public function getPropertyStatus(Request $request, PropertyStatusRepository $propertyStatusRepository)
    {

        $validatedData = $request->validate([
            'start' => 'required',
            'length' => 'required',
            'deleted' => 'required',
            'order' => 'required',
            'search' => 'required',
            'columns' => 'required'
        ]);

        // Get values from validated input data:
        $offset   = $validatedData["start"];
        $limit    = $validatedData["length"];
        $deleted  = $validatedData["deleted"];
        $order    = $validatedData["order"];
        $search   = $validatedData["search"];
        $columns  = $validatedData["columns"];

        // Define how to order items:
        $orderBy = $columns[$order[0]["column"]]["data"];
        $order   = $order[0]["dir"];

        // Keyword to filter items:
        $keyword = $search["value"];

        // Repository method to retrieve data from database:
        $propertyStatusList  = $propertyStatusRepository->getStatusList($deleted, $offset, $limit, $orderBy, $order, $keyword);

        // DTO to return as an AJAX response:
        $propertyStatusListResponse = [];

        // Add buttons to the rows, to edit, delete, remove or restore:
        if(sizeof($propertyStatusList)){
            foreach($propertyStatusList AS $propertyStatus){
                $editButton = '<span class="admin-list-control-buttons admin-list-edit" data-id="'.$propertyStatus["id"].'"><a href="/admin/property-status/edit/'.$propertyStatus["id"].'"><i class="far fa-edit"></i><span class="admin-list-control-label">'.__("admin.edit").'</span></a></span>';
                $deleteButton = '<span data-toggle="modal" data-target="#delete_confirm" class="admin-list-control-buttons admin-list-delete" data-id="'.$propertyStatus["id"].'"><i class="far fa-trash-alt"></i><span class="admin-list-control-label">'.__("admin.delete").'</span></span>';
                $removeButton = '<span data-toggle="modal" data-target="#remove_confirm" class="admin-list-control-buttons admin-list-remove" data-id="'.$propertyStatus["id"].'"><i class="fas fa-trash"></i><span class="admin-list-control-label">'.__("admin.remove").'</span></span>';
                $restoreButton = '<span data-toggle="modal" data-target="#restore_confirm" class="admin-list-control-buttons admin-list-restore" data-id="'.$propertyStatus["id"].'"><i class="fas fa-arrow-up"></i><span class="admin-list-control-label">'.__("admin.restore").'</span></span>';
                
                if($deleted == false) 
                {
                    $propertyStatus["buttons"] = $editButton.$deleteButton;
                    $propertyStatusListResponse[] = $propertyStatus;
                } else {
                    $propertyStatus["buttons"] = $restoreButton.$removeButton;
                    $propertyStatusListResponse[] = $propertyStatus;
                }
            }
        }

        // Get count of filtered & all results:
        $propertyStatusFilteredCount = $propertyStatusRepository->findWhere(['deleted'=>$deleted, 'title'=>"%".$keyword."%"])->count();
        $propertyStatusCount = $propertyStatusRepository->findWhere(['deleted'=>$deleted])->count();
        // $propertyStatusFilteredCount = $propertyStatusRepository->getStatusListFilteredCount($deleted, $keyword);
        // $propertyStatusCount = $propertyStatusRepository->getStatusListCount($deleted);

        $propertyStatusList = ["data"=>$propertyStatusListResponse, "recordsTotal"=>$propertyStatusCount, "recordsFiltered"=>$propertyStatusFilteredCount];

        return response()->json($propertyStatusList);

    }

    /*
     *  Api method to delete by item id
     *    
     *  @param $itemId id of the item to be deleted
     *
     *  @return \Symfony\Component\HttpFoundation\Response 
     */
    public function deletePropertyStatus(Request $request, PropertyStatusRepository $propertyStatusRepository){

        $validatedData = $request->validate([
            'item_id' => 'required'
        ]);

        $itemId = (int) $validatedData["item_id"];
        $updateResponse = $propertyStatusRepository->deletePropertyStatus($itemId);

        return response()->json($updateResponse);
    }

    /*
     *  Api method to remove by item id
     *    
     *  @param $itemId id of the item to be removed
     *
     *  @return \Symfony\Component\HttpFoundation\Response 
     */
    public function removePropertyStatus(Request $request, PropertyStatusRepository $propertyStatusRepository){

        $validatedData = $request->validate([
            'item_id' => 'required'
        ]);

        $itemId = (int) $validatedData["item_id"];
        $updateResponse = $propertyStatusRepository->removePropertyStatus($itemId);

        return response()->json($updateResponse);
    }

    /*
     *  Api method to restore by item id
     *    
     *  @param $itemId id of the item to be removed
     *
     *  @return \Symfony\Component\HttpFoundation\Response 
     */
    public function restorePropertyStatus(Request $request, PropertyStatusRepository $propertyStatusRepository){

        $validatedData = $request->validate([
            'item_id' => 'required'
        ]);

        $itemId = (int) $validatedData["item_id"];
        
        $updateResponse = $propertyStatusRepository->restorePropertyStatus($itemId);
        
        return response()->json($updateResponse);

    }

    /*
    * Api method to save (create, update) item 
    *
    * @param @id   If id is defined, action shall be an update
    * @param @name Name of the item
    * @param @slug Slug of the item  
    *
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
