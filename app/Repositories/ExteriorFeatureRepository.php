<?php

    namespace App\Repositories;

    use App\ExteriorFeature as ExteriorFeature;
    use Prettus\Repository\Eloquent\BaseRepository;

    class ExteriorFeatureRepository extends BaseRepository{

        /**
         * Specify Model class name
         *
         * @return string
         */
        function model()
        {
            return "App\\ExteriorFeature";
        }

        /*
        * Returns list count
        *
        * @param $deleted Is deleted?
        *
        * @return integer
        */
        public function getExteriorFeatureListCount($deleted = false) 
        {

            $exteriorFeatureObject = ExteriorFeature::where(['is_deleted'=>$deleted]);

            return $exteriorFeatureObject->count();                                    
        }                            

        /*
        * Returns filtered list count
        *
        * @param $deleted List deleted or not
        * @param $keyword 
        *
        * @return integer
        */
        public function getExteriorFeatureListFilteredCount($deleted = false, $keyword = NULL) 
        {

            $exteriorFeatureObject = ExteriorFeature::where(['is_deleted'=>$deleted]);

            if($keyword != NULL){
                $exteriorFeatureObject = $exteriorFeatureObject->where('title', 'like', '%'.$keyword.'%');
            }

            return $exteriorFeatureObject->count();                                    
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

            $exteriorFeatureObject = ExteriorFeature::select('id', 'title', 'slug')
                                    ->where(
                                        [
                                            'id'=>$itemId,
                                            'is_deleted'=>false
                                        ]
                                    );

            return $exteriorFeatureObject->first()->toArray();

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
        public function getExteriorFeatureList($deleted = false, $offset = NULL, $limit = NULL, $orderBy = NULL, $order = NULL, $keyword = NULL) 
        {

            $exteriorFeatureObject = ExteriorFeature::select('id', 'title', 'slug')
                                        ->where(['is_deleted'=>$deleted]);

                // If offset is defined:
                if($offset != NULL){
                    $exteriorFeatureObject = $propertyStatusObject->offset($offset);
                }

                // If limit is defined:
                if($limit != NULL){
                    $exteriorFeatureObject = $propertyStatusObject->limit($limit);
                }

                if($order != NULL){
                    $exteriorFeatureObject = $propertyStatusObject->orderBy($orderBy, $order);
                }

                if($keyword != NULL){
                    $exteriorFeatureObject = $propertyStatusObject->where('title', 'like', '%'.$keyword.'%');
                }

            return $exteriorFeatureObject->get()->toArray();

        }

        /*
        * Saves with given arguments
        *
        * @param $title title of the item
        * @param $slug Slug of the item
        *
        * @return App\\PropertyStatus
        */
        public function saveExteriorFeature($title, $slug)
        {
            return ExteriorFeature::create(["title"=>$title, "slug"=>$slug]);
        }

        /*
        * Saves with given arguments
        *
        * @param $id Id of the item
        * @param $title title of the item
        * @param $slug Slug of the item
        *
        * @return App\\PropertyStatus
        */
        public function updateExteriorFeature($id, $title, $slug)
        {
            return ExteriorFeature::where("id", $id)->update(["title"=>$title, "slug"=>$slug]);
        }

        /*
        * Removes the item from the database
        *
        * @param $id Id of the item to be removed
        *
        * @return boolean
        */
        public function removeExteriorFeature($id)
        {
            $isDeleted = ExteriorFeature::where('id', $id)->delete();
                return $isDeleted;
        }

        /*
        * Soft deletes the item with given id
        *
        * @param $id Id of the item to be soft deleted
        *
        * @return App\\ExteriorFeature
        */
        public function deleteExteriorFeature($id)
        {
            $exteriorFeature = ExteriorFeature::find($id);
                $exteriorFeature->is_deleted = true;
                $exteriorFeature->save();
                return $exteriorFeature;
        }

        /*
        * Restore the given item with given id (after soft delete)
        *
        * @param $id Id of the item to be restored
        *
        * @return App\\ExteriorFeature
        */
        public function restoreExteriorFeature($id)
        {
            $exteriorFeature = ExteriorFeature::find($id);
                $exteriorFeature->is_deleted = false;
                $exteriorFeature->save();
                    return $exteriorFeature;
        }

    }    