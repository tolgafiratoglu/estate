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

        function getPropertyTypes($deleted = false, $offset = NULL, $limit = NULL, $orderBy = NULL, $order = NULL, $keyword = NULL)
        {

            $propertyTypesObject = PropertyType::select('id', 'name', 'slug')
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
                    $propertyTypesObject = $propertyTypesObject->where('name', 'like', '%'.$keyword.'%');
                }

            return $propertyTypesObject->get()->toArray();

        }

    }
    
?>    