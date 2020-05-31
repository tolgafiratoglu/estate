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

        public function getPropertyStatus($itemId) {

            $propertyStatusObject = PropertyStatus::select('id', 'name', 'slug')
                                    ->where(
                                        [
                                            'id'=>$itemId,
                                            'is_deleted'=>false
                                        ]
                                    );

            return $propertyStatusObject->first()->toArray();

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

        public function savePropertyStatus($name, $slug){
            return PropertyStatus::create(["name"=>$name, "slug"=>$slug]);
        }

        public function updatePropertyStatus($id, $name, $slug){
            return PropertyStatus::where("id", $id)->update(["name"=>$name, "slug"=>$slug]);
        }

        public function slugExists($slug, $id){
            $criterias = [['slug', '=', $slug]];
            if($id != NULL){
                $criterias.push(['id', '!=', $id]);
            }
            return PropertyStatus::where($criterias)->count();
        }

        public function nameExists($name, $id){
            $criterias = [['name', '=', $name]];
            if($id != NULL){
                $criterias.push(['id', '!=', $id]);
            }
            return PropertyStatus::where($criterias)->count();
        }

    }    