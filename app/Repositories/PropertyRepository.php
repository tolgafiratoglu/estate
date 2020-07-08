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
        * @param $deleted if items are deleted or not
        * @param $offset offset of the collection
        * @param $limit limit of the collection
        * @param $orderBy order by a field
        * @param $order sort criteria
        * @param $keyword 
        *
        * @return array
        */
        public function getPropertyList($deleted = false, $offset = NULL, $limit = NULL, $orderBy = NULL, $order = NULL, $keyword = NULL) 
        {

            $propertyListObject = Property::select('id', 'created_at', 'updated_at', 'location', 'created_by', 'property_status',	'property_type',	'featured_image', 'price', 'address', 'area', 'year_built', 'number_of_rooms', 'number_of_bathrooms', 'which_floor', 'number_of_floors',  'lat', 'lon', 'is_approved', 'is_drafted', 'is_deleted', 'has_garden', 'area_of_garden', 'has_park_area', 'number_of_park_areas')
                                        ->where(['is_deleted'=>$deleted]);

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