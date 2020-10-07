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

        public function getPropertyIdBySlug($slug)
        {

            $propertyObj = Property::select('id')->where(['slug'=>$slug])->first();

            if($propertyObj != NULL){
                return $propertyObj->toArray()['id'];
            }else{
                return NULL;
            }

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
        * Returns property info by a given slug
        *  
        * @param $slug Unique slug of the property.
        *
        * @return array
        */
        public function getSingleBySlug($propertyId)
        {

            $propertyQuery = Property::select(
                                                'property.id AS id', 
                                                'property.title AS property_title', 
                                                'property.slug AS slug', 
                                                'property.description AS description',
                                                'property.is_custom_info',
                                                'property.custom_info_name AS custom_name',
                                                'property.custom_info_phone AS custom_phone',
                                                'property.custom_info_email AS custom_email',
                                                'location', 
                                                'location.name AS location_name', 
                                                'price', 
                                                'address', 
                                                'area', 
                                                'number_of_rooms', 
                                                'number_of_bathrooms', 
                                                'which_floor', 
                                                'number_of_floors', 
                                                'lat', 
                                                'lon', 
                                                'approval_status', 
                                                'is_drafted', 
                                                'has_garden',
                                                'area_of_garden',
                                                'has_park_area',
                                                'number_of_park_areas',
                                                'media.folder AS featured_image_folder', 
                                                'media.name AS feature_image_file_name',
                                                'users.name AS user_name',
                                                'users.lastname AS user_lastname',
                                                'users.email AS user_email',
                                                'users.is_agent AS user_is_agent',
                                                'heating.title AS heating_title',
                                                'cooling.title AS cooling_title',
                                                'year_built'
                                            )
                                            ->leftJoin('media', 'property.featured_image', '=', 'media.id')
                                            ->leftJoin('location', 'property.location', '=', 'location.id')
                                            ->leftJoin('property_status', 'property.property_status', '=', 'property_status.id')
                                            ->leftJoin('property_type', 'property.property_type', '=', 'property_type.id')
                                            ->leftJoin('heating', 'property.heating', '=', 'heating.id')
                                            ->leftJoin('cooling', 'property.cooling', '=', 'cooling.id')
                                                ->join('users', 'users.id', '=', 'property.created_by')
                                                ->where(['property.id'=>$propertyId, 'property.is_deleted'=>false])
                                                    ->where(['users.is_blocked'=>false]);

            $propertyObject = $propertyQuery->first();

            if($propertyObject != NULL){
                return $propertyObject->toArray();                                                    
            } else {
                return NULL;
            }
        }

        /*
         * Property query base 
        */
        public function propertyQueryBase()
        {
            return Property::select('property.id AS id', 'property.title AS property_title', 'property.slug AS slug', 'location', 'location.name AS location_name', 'price', 'address', 'area', 'number_of_rooms', 'number_of_bathrooms', 'which_floor', 'number_of_floors', 'lat', 'lon', 'approval_status', 'is_drafted', 'media.folder AS featured_image_folder', 'media.name AS feature_image_file_name')
                                ->leftJoin('media', 'property.featured_image', '=', 'media.id')
                                ->leftJoin('location', 'property.location', '=', 'location.id')
                                ->join('users', 'users.id', '=', 'property.created_by')
                                ->where(['users.is_blocked'=>false]);
        }

        /* 
         * Search properties
        */
        public function search(
            $propertyType = 0,
            $propertyStatus = 0,
            $minPrice = NULL,
            $maxPrice = NULL,
            $location = 0,
            $interiorFeatures = NULL,
            $exteriorFeatures = NULL,
            $area = NULL,
            $floor = NULL,
            $numberOfRooms = NULL,
            $hasParkArea = NULL,
            $ageOfBuilding = NULL,
            $address = NULL,
            $keyword = NULL,
            $offset = 0, 
            $limit = 12, 
            $orderBy = 'id',
            $order = 'DESC'
        ){

            

            $searchObject = $this->propertyQueryBase()
                                ->where(
                                        [
                                            'property.is_deleted'=>false, 
                                            'property.approval_status'=>'approved', 
                                            'property.is_drafted'=>false
                                        ]
                                    );   

                // Set location if not zero                                    
                if($location > 0)
                {
                    $searchObject = $searchObject->where('location', '=', $location);
                }

                // Property status:
                if($propertyStatus > 0)
                {
                    $searchObject = $searchObject->where('property_status', '=', $propertyStatus);
                }

                // Property type:
                if($propertyType > 0)
                {
                    $searchObject = $searchObject->where('property_type', '=', $propertyType);
                }

                // Min Price:
                if($minPrice != NULL)
                {
                    $searchObject = $searchObject->where('price', '>=', $minPrice);
                }

                // Max Price:
                if($maxPrice != NULL)
                {
                    $searchObject = $searchObject->where('price', '<=', $maxPrice);
                }

                // Set offset if not null:
                if($offset != NULL){
                    $searchObject = $searchObject->offset($offset);
                }

                // If limit is defined:
                if($limit != NULL){
                    $searchObject = $searchObject->limit($limit);
                }

                // Set order if defined:
                if($order != NULL){
                    $searchObject = $searchObject->orderBy($orderBy, $order);
                }

                // echo $searchObject->toSql();

            return $searchObject->get()->toArray();

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
        public function getPropertyList($isDeleted = false, $approvalStatus = 'approved', $isDrafted = false, $offset = NULL, $limit = NULL, $orderBy = NULL, $order = NULL, $keyword = NULL) 
        {

            $propertyListObject = $this->propertyQueryBase()
                                    ->where(
                                        ['property.is_deleted'=>$isDeleted, 
                                         'property.approval_status'=>$approvalStatus, 
                                         'property.is_drafted'=>$isDrafted]
                                        );                                   

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