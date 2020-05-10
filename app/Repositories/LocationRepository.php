<?php

    namespace App\Repositories;

    use App\Location as Location;
    use Rinvex\Repository\Repositories\EloquentRepository;

    class LocationRepository extends EloquentRepository{

        protected $repositoryId = 'estate.repository.location';

        protected $model = 'App\Location';

        public function getLocations($enabled = true, $deleted = false, $parentId = NULL, $offset = NULL, $limit = NULL){

            $locationsObject = Location::select('name', 'slug')
                                    ->where(
                                        [
                                            'enabled'=>true,
                                            'deleted'=>false
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