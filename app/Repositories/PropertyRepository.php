<?php

    namespace App\Repositories;

    use App\Property as Property;
    use Prettus\Repository\Eloquent\BaseRepository;

    class PropertyRepository extends BaseRepository{

        /**
         * Specify Model class name
         *
         * @return string
         */
        function model()
        {
            return "App\\Property";
        }

        /*
        * Minimum area for any given field:
        * @return integer
        */
        public function getMinValue($field)
        {
            return Property::min($field);
        }

        /*
        * Maximum value for any given field
        * @return integer
        */
        public function getMaxValue($field)
        {
            return Property::max($field);
        }

        /*
        * Returns list of items defined by parameters
        *
        * @param $isDeleted if items are deleted or not
        * @param $isApproved if items are approved or not
        * @param $isDrafted if items are drafted or not
        * @param $offset offset of the collection
        * @param $limit limit of the collection
        * @param $orderBy order by a field
        * @param $order sort criteria
        * @param $keyword 
        *
        * @return array
        */
        public function getPropertyList($isDeleted = false, $isApproved = true, $isDrafted = false, $offset = NULL, $limit = NULL, $orderBy = NULL, $order = NULL, $keyword = NULL) 
        {

            $propertyListObject = Property::select('property.id AS id', 'property.title AS property_title', 'location', 'location.name AS location_name', 'price', 'address', 'area', 'number_of_rooms', 'number_of_bathrooms', 'which_floor', 'number_of_floors', 'lat', 'lon', 'is_approved', 'is_drafted', 'media.folder AS featured_image_folder', 'media.name AS feature_image_file_name')
                                            ->leftJoin('media', 'property.featured_image', '=', 'media.id')
                                            ->leftJoin('location', 'property.location', '=', 'location.id')
                                            ->join('users', 'users.id', '=', 'property.created_by')
                                            ->where(['property.is_deleted'=>$isDeleted, 'property.is_approved'=>$isApproved, 'property.is_drafted'=>$isDrafted])
                                                ->where(['users.is_blocked'=>false]);                                                                

                // If offset is defined:
                if($offset != NULL){
                    $propertyListObject = $propertyListObject->offset($offset);
                }

                // If limit is defined:
                if($limit != NULL){
                    $propertyListObject = $propertyListObject->limit($limit);
                }

                if($order != NULL){
                    $propertyListObject = $propertyListObject->orderBy($orderBy, $order);
                }

                if($keyword != NULL){
                    $propertyListObject = $propertyListObject->where('title', 'like', '%'.$keyword.'%');
                }

            return $propertyListObject->get()->toArray();

        }

    }
    
?>    