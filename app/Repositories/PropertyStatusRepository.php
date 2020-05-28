<?php

    namespace App\Repositories;

    use App\PropertyStatus as PropertyStatus;
    use Rinvex\Repository\Repositories\EloquentRepository;

    class PropertyStatusRepository extends EloquentRepository{

        protected $repositoryId = 'estate.repository.property_status';

        protected $model = 'App\PropertyStatus';

        public function getStatusListCount($deleted = false) {

            $propertyStatusObject = PropertyStatus::select('id', 'name', 'slug')
                                    ->where(['is_deleted'=>$deleted]);

            return $propertyStatusObject->count();                                    

        }                            

        public function getStatusList($deleted = false, $offset = NULL, $limit = NULL) {

            $propertyStatusObject = PropertyStatus::select('id', 'name', 'slug')
                                    ->where(
                                        [
                                            'is_deleted'=>$deleted
                                        ]
                                    );

                // If offset is defined:
                if($offset != NULL){
                    $propertyStatusObject = $propertyStatusObject->offset($offset);
                }

                // If limit is defined:
                if($limit != NULL){
                    $propertyStatusObject = $propertyStatusObject->limit($limit);
                }

            return $propertyStatusObject->get()->toArray();

        }

    }    