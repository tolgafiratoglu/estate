<?php

    namespace App\Repositories;

    use App\Location as Location;
    use Prettus\Repository\Eloquent\BaseRepository;

    class LocationRepository extends BaseRepository{

        /**
         * Specify Model class name
         *
         * @return string
         */
        function model()
        {
            return "App\\Location";
        }

        public function getLocations($deleted = false, $parentId = NULL, $offset = NULL, $limit = NULL){

            $locationsObject = Location::select('id', 'name', 'slug')
                                    ->where(
                                        [
                                            'deleted'=>$deleted
                                        ]
                                    );

                // If parent id is defined:                    
                if($parentId != NULL){
                    $locationsObject = $locationsObject->where(['parent'=>$parentId]);
                }

                // If offset is defined:
                if($offset != NULL){
                    $locationsObject = $locationsObject->offset($offset);
                }

                // If limit is defined:
                if($limit != NULL){
                    $locationsObject = $locationsObject->limit($offset);
                }

            return $locationsObject->get()->toArray();

        }

    }    