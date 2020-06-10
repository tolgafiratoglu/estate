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

        public function getStatusListCount($deleted = false) 
        {

            $propertyStatusObject = PropertyStatus::select('id', 'name', 'slug')
                                    ->where(['is_deleted'=>$deleted]);

            return $propertyStatusObject->count();                                    

        }                            

        public function getPropertyStatus($itemId) 
        {

            $propertyStatusObject = PropertyStatus::select('id', 'name', 'slug')
                                    ->where(
                                        [
                                            'id'=>$itemId,
                                            'is_deleted'=>false
                                        ]
                                    );

            return $propertyStatusObject->first()->toArray();

        }

        public function getStatusList($deleted = false, $offset = NULL, $limit = NULL, $orderBy = NULL, $order = NULL, $keyword = NULL) 
        {

            $propertyStatusObject = PropertyStatus::select('id', 'name', 'slug')
                                        ->where(['is_deleted'=>$deleted]);

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
                    $propertyStatusObject = $propertyStatusObject->where('name', 'like', '%'.$keyword.'%');
                }

            return $propertyStatusObject->get()->toArray();

        }

        public function savePropertyStatus($name, $slug)
        {
            return PropertyStatus::create(["name"=>$name, "slug"=>$slug]);
        }

        public function updatePropertyStatus($id, $name, $slug)
        {
            return PropertyStatus::where("id", $id)->update(["name"=>$name, "slug"=>$slug]);
        }

        public function removePropertyStatus($id)
        {
            $isDeleted = PropertyStatus::where('id', $id)->delete();
                return $isDeleted;
        }

        public function deletePropertyStatus($id)
        {
            $propertyStatus = PropertyStatus::find($id);
                $propertyStatus->is_deleted = true;
                $propertyStatus->save();
                return $propertyStatus;
        }

        public function undoDeletePropertyStatus($id)
        {
            $propertyStatus = PropertyStatus::find($id);
                $propertyStatus->is_deleted = false;
                $propertyStatus->save();
                    return $propertyStatus;
        }

    }    