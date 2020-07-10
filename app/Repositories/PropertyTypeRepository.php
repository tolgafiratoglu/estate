<?php

    namespace App\Repositories;

    use App\PropertyType as PropertyType;
    use Prettus\Repository\Eloquent\BaseRepository;

    class PropertyTypeRepository extends BaseRepository{

        /**
         * Specify Model class name
         *
         * @return string
         */
        function model()
        {
            return "App\\PropertyType";
        }

        /*
        * Returns list count
        *
        * @param $deleted Is deleted?
        *
        * @return integer
        */
        public function getTypesListCount($deleted = false) 
        {

            $propertyTypesObject = PropertyType::count();                                    
        }

        /*
        * Returns filtered list count
        *
        * @param $deleted List deleted or not
        * @param $keyword 
        *
        * @return integer
        */
        public function getTypeListFilteredCount($deleted = false, $keyword = NULL) 
        {

            $propertyTypeObject = PropertyType::where(['is_deleted'=>$deleted]);

            if($keyword != NULL){
                $propertyTypeObject = $propertyStatusObject->where('title', 'like', '%'.$keyword.'%');
            }

            return $propertyTypeObject->count();                                    
        }

        /*
        * Returns item by item id
        *
        * @param $itemId Id of the item
        *
        * @return array
        */
        public function getPropertyType($itemId) 
        {

            $propertyStatusObject = PropertyType::select('id', 'title', 'slug')
                                    ->where(
                                        [
                                            'id'=>$itemId
                                        ]
                                    );

            return $propertyStatusObject->first()->toArray();

        }

        function getPropertyTypes($deleted = false, $offset = NULL, $limit = NULL, $orderBy = NULL, $order = NULL, $keyword = NULL)
        {

            $propertyTypesObject = PropertyType::select('id', 'title', 'slug')
                                        ->where(['is_deleted'=>$deleted]);

                // If offset is defined:
                if($offset != NULL){
                    $propertyTypesObject = $propertyTypesObject->offset($offset);
                }

                // If limit is defined:
                if($limit != NULL){
                    $propertyTypesObject = $propertyTypesObject->limit($limit);
                }

                if($order != NULL){
                    $propertyTypesObject = $propertyTypesObject->orderBy($orderBy, $order);
                }

                if($keyword != NULL){
                    $propertyTypesObject = $propertyTypesObject->where('title', 'like', '%'.$keyword.'%');
                }

            return $propertyTypesObject->get()->toArray();

        }

        /*
        * Saves with given arguments
        *
        * @param $title Title of the item
        * @param $slug Slug of the item
        *
        * @return App\\PropertyStatus
        */
        public function savePropertyType($title, $slug)
        {
            return PropertyType::create(["title"=>$title, "slug"=>$slug]);
        }

        /*
        * Saves with given arguments
        *
        * @param $id Id of the item
        * @param $name Name of the item
        * @param $slug Slug of the item
        *
        * @return App\\PropertyStatus
        */
        public function updatePropertyType($id, $title, $slug)
        {
            return PropertyType::where("id", $id)->update(["title"=>$title, "slug"=>$slug]);
        }

        /*
        * Removes the item from the database
        *
        * @param $id Id of the item to be removed
        *
        * @return boolean
        */
        public function removePropertyType($id)
        {
            $isDeleted = PropertyType::where('id', $id)->delete();
                return $isDeleted;
        }

        /*
        * Soft deletes the item with given id
        *
        * @param $id Id of the item to be soft deleted
        *
        * @return App\\PropertyStatus
        */
        public function deletePropertyType($id)
        {
            $propertyStatus = PropertyType::find($id);
                $propertyStatus->is_deleted = true;
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
        public function restorePropertyType($id)
        {
            $propertyStatus = PropertyType::find($id);
                $propertyStatus->is_deleted = false;
                $propertyStatus->save();
                    return $propertyStatus;
        }

    }
    
?>    