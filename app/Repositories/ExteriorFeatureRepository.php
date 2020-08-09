<?php

    namespace App\Repositories;

    use App\ExteriorFeature as ExteriorFeature;
    use Prettus\Repository\Eloquent\BaseRepository;

    class ExteriorFeatureRepository extends BaseRepository
    {

        /**
         * Specify Model class name
         *
         * @return string
         */
        function model()
        {
            return "App\\ExteriorFeature";
        }

        public function getPropertyFeatures($propertyId)
        {
            return ExteriorFeature::select('exterior_feature.id AS feature_id', 'exterior_feature.title AS feature_title')
                        ->leftJoin('property_exterior_feature', 'property_exterior_feature.exterior_feature', '=', 'exterior_feature.id')
                        ->leftJoin('property', 'property.id', '=', 'property_exterior_feature.property')
                        ->where(["property.id" => $propertyId])
                        ->get()->toArray();
        }

        /*
        * Returns list count
        *
        *
        * @return integer
        */
        public function getExteriorFeatureListCount($deleted = false) 
        {
            return ExteriorFeature::count();                                   
        }                            

        /*
        * Returns filtered list count
        *
        * @param $keyword 
        *
        * @return integer
        */
        public function getExteriorFeatureCount($keyword = NULL) 
        {

            $ExteriorFeatureObject = ExteriorFeature::findAll();

            if($keyword != NULL){
                $ExteriorFeatureObject = ExteriorFeature::where('title', 'like', '%'.$keyword.'%');
            }

            return $ExteriorFeatureObject->count();       

        }

        /*
        * Returns item by item id
        *
        * @param $itemId Id of the item
        *
        * @return array
        */
        public function getExteriorFeature($itemId) 
        {

            $ExteriorFeatureObject = ExteriorFeature::select('id', 'title')
                                    ->where(
                                        [
                                            'id'=>$itemId
                                        ]
                                    );

            return $ExteriorFeatureObject->first()->toArray();

        }

        /*
        * Returns list of items defined by parameters
        *
        * @param $offset offset of the collection
        * @param $limit limit of the collection
        * @param $orderBy order by a field
        * @param $order sort criteria
        * @param $keyword 
        *
        * @return array
        */
        public function getExteriorFeatureList($offset = NULL, $limit = NULL, $orderBy = NULL, $order = NULL, $keyword = NULL) 
        {

            $ExteriorFeatureObject = ExteriorFeature::select('id', 'title');

                if($keyword != NULL){
                    $ExteriorFeatureObject = $ExteriorFeatureObject->where('title', 'like', '%'.$keyword.'%');
                }

                // If offset is defined:
                if($offset != NULL){
                    $ExteriorFeatureObject = $ExteriorFeatureObject->offset($offset);
                }

                // If limit is defined:
                if($limit != NULL){
                    $ExteriorFeatureObject = $ExteriorFeatureObject->limit($limit);
                }

                if($order != NULL){
                    $ExteriorFeatureObject = $ExteriorFeatureObject->orderBy($orderBy, $order);
                }


            return $ExteriorFeatureObject->get()->toArray();

        }

        /*
        * Saves with given arguments
        *
        * @param $title title of the item
        *
        * @return App\\ExteriorFeature
        */
        public function saveExteriorFeature($title, $lat, $lon)
        {
            return ExteriorFeature::create(["title"=>$title]);
        }

        /*
        * Saves with given arguments
        *
        * @param $id Id of the item
        * @param $title title of the item
        *
        * @return App\\ExteriorFeature
        */
        public function updateExteriorFeature($id, $title)
        {
            return ExteriorFeature::where("id", $id)->update(["title"=>$title]);
        }

        /*
        * Deletes the item from the database
        *
        * @param $id Id of the item to be removed
        *
        * @return boolean
        */
        public function deleteExteriorFeature($id)
        {
            $isDeleted = ExteriorFeature::where('id', $id)->delete();
                return $isDeleted;
        }


    }    