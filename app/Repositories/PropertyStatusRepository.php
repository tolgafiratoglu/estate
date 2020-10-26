<?php

    namespace App\Repositories;

    use App\PropertyStatus as PropertyStatus;
    use Prettus\Repository\Eloquent\BaseRepository;

    class PropertyStatusRepository extends BaseRepository{

        /**
         * Specify Model class name
         *
         * @return string
         */
        function model()
        {
            return "App\\PropertyStatus";
        }                            

        /*
        * Returns filtered list count
        *
        * @param $deleted List deleted or not
        * @param $keyword 
        *
        * @return integer
        */
        public function getStatusListFilteredCount($deleted = false, $keyword = NULL) 
        {

            $propertyStatusObject = PropertyStatus::where(['deleted'=>$deleted]);

            if($keyword != NULL){
                $propertyStatusObject = $propertyStatusObject->where('title', 'like', '%'.$keyword.'%');
            }

            return $propertyStatusObject->count();                                    
        }

        /*
        * Returns item by item id
        *
        * @param $itemId Id of the item
        *
        * @return array
        */
        public function getPropertyStatus($itemId) 
        {

            $propertyStatusObject = PropertyStatus::select('id', 'title', 'slug')
                                    ->where(
                                        [
                                            'id'=>$itemId,
                                            'deleted'=>false
                                        ]
                                    );

            return $propertyStatusObject->first()->toArray();

        }

        /*
        * Returns list of items defined by parameters
        *
        * @param $deleted if items are deleted or not
        * @param $offset offset of the collection
        * @param $limit limit of the collection
        * @param $orderBy order by a field
        * @param $order sort criteria
        * @param $keyword 
        *
        * @return array
        */
        public function getStatusList($deleted = false, $offset = NULL, $limit = NULL, $orderBy = NULL, $order = NULL, $keyword = NULL) 
        {

            $propertyStatusObject = PropertyStatus::select('id', 'title', 'slug');

                if($deleted != NULL){
                    $propertyStatusObject = $propertyStatusObject->where(["deleted"=>$deleted]);
                }

                // If offset is defined:
                if($offset != NULL){
                    $propertyStatusObject = $propertyStatusObject->offset($offset);
                }

                // If limit is defined:
                if($limit != NULL){
                    $propertyStatusObject = $propertyStatusObject->limit($limit);
                }

                if($order != NULL){
                    $propertyStatusObject = $propertyStatusObject->orderBy($orderBy, $order);
                }

                if($keyword != NULL){
                    $propertyStatusObject = $propertyStatusObject->where('title', 'like', '%'.$keyword.'%');
                }

            return $propertyStatusObject->get()->toArray();

        }

        /*
        * Saves with given arguments
        *
        * @param $title Title of the item
        * @param $slug Slug of the item
        *
        * @return App\\PropertyStatus
        */
        public function savePropertyStatus($title, $slug)
        {
            return PropertyStatus::create(["title"=>$title, "slug"=>$slug]);
        }

        /*
        * Saves with given arguments
        *
        * @param $id Id of the item
        * @param $title Title of the item
        * @param $slug Slug of the item
        *
        * @return App\\PropertyStatus
        */
        public function updatePropertyStatus($id, $title, $slug)
        {
            return PropertyStatus::where("id", $id)->update(["title"=>$title, "slug"=>$slug]);
        }

        /*
        * Removes the item from the database
        *
        * @param $id Id of the item to be removed
        *
        * @return boolean
        */
        public function removePropertyStatus($id)
        {
            $isDeleted = PropertyStatus::where('id', $id)->delete();
                return $isDeleted;
        }

        /*
        * Soft deletes the item with given id
        *
        * @param $id Id of the item to be soft deleted
        *
        * @return App\\PropertyStatus
        */
        public function deletePropertyStatus($id)
        {
            $propertyStatus = PropertyStatus::find($id);
                $propertyStatus->deleted = true;
                $propertyStatus->save();
                return $propertyStatus;
        }

        /*
        * Restore the given item with given id (after soft delete)
        *
        * @param $id Id of the item to be restored
        *
        * @return App\\PropertyStatus
        */
        public function restorePropertyStatus($id)
        {
            $propertyStatus = PropertyStatus::find($id);
                $propertyStatus->deleted = false;
                $propertyStatus->save();
                    return $propertyStatus;
        }

    }    