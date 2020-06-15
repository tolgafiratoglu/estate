<?php

    namespace App\Repositories;

    use App\InteriorFeature as InteriorFeature;
    use Prettus\Repository\Eloquent\BaseRepository;

    class InteriorFeatureRepository extends BaseRepository{

        /**
         * Specify Model class name
         *
         * @return string
         */
        function model()
        {
            return "App\\InteriorFeature";
        }

        /*
        * Returns list count
        *
        * @param $deleted Is deleted?
        *
        * @return integer
        */
        public function getInteriorFeatureListCount($deleted = false) 
        {

            $interiorFeatureObject = InteriorFeature::where(['is_deleted'=>$deleted]);

            return $interiorFeatureObject->count();                                    
        }                            

        /*
        * Returns filtered list count
        *
        * @param $deleted List deleted or not
        * @param $keyword 
        *
        * @return integer
        */
        public function getInteriorFeatureListFilteredCount($deleted = false, $keyword = NULL) 
        {

            $interiorFeatureObject = InteriorFeature::where(['is_deleted'=>$deleted]);

            if($keyword != NULL){
                $interiorFeatureObject = $interiorFeatureObject->where('name', 'like', '%'.$keyword.'%');
            }

            return $interiorFeatureObject->count();                                    
        }

        /*
        * Returns item by item id
        *
        * @param $itemId Id of the item
        *
        * @return array
        */
        public function getInteriorFeature($itemId) 
        {

            $interiorFeatureObject = InteriorFeature::select('id', 'name', 'slug')
                                    ->where(
                                        [
                                            'id'=>$itemId,
                                            'is_deleted'=>false
                                        ]
                                    );

            return $interiorFeatureObject->first()->toArray();

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
        public function getInteriorFeatureList($deleted = false, $offset = NULL, $limit = NULL, $orderBy = NULL, $order = NULL, $keyword = NULL) 
        {

            $interiorFeatureObject = InteriorFeature::select('id', 'name', 'slug')
                                        ->where(['is_deleted'=>$deleted]);

                // If offset is defined:
                if($offset != NULL){
                    $interiorFeatureObject = $propertyStatusObject->offset($offset);
                }

                // If limit is defined:
                if($limit != NULL){
                    $interiorFeatureObject = $propertyStatusObject->limit($limit);
                }

                if($order != NULL){
                    $interiorFeatureObject = $propertyStatusObject->orderBy($orderBy, $order);
                }

                if($keyword != NULL){
                    $interiorFeatureObject = $propertyStatusObject->where('name', 'like', '%'.$keyword.'%');
                }

            return $interiorFeatureObject->get()->toArray();

        }

        /*
        * Saves with given arguments
        *
        * @param $name Name of the item
        * @param $slug Slug of the item
        *
        * @return App\\PropertyStatus
        */
        public function saveInteriorFeature($name, $slug)
        {
            return InteriorFeature::create(["name"=>$name, "slug"=>$slug]);
        }

        /*
        * Saves with given arguments
        *
        * @param $id Id of the item
        * @param $name Name of the item
        * @param $slug Slug of the item
        *
        * @return App\\PropertyStatus
        */
        public function updateInteriorFeature($id, $name, $slug)
        {
            return InteriorFeature::where("id", $id)->update(["name"=>$name, "slug"=>$slug]);
        }

        /*
        * Removes the item from the database
        *
        * @param $id Id of the item to be removed
        *
        * @return boolean
        */
        public function removeInteriorFeature($id)
        {
            $isDeleted = InteriorFeature::where('id', $id)->delete();
                return $isDeleted;
        }

        /*
        * Soft deletes the item with given id
        *
        * @param $id Id of the item to be soft deleted
        *
        * @return App\\InteriorFeature
        */
        public function deleteInteriorFeature($id)
        {
            $interiorFeature = InteriorFeature::find($id);
                $interiorFeature->is_deleted = true;
                $interiorFeature->save();
                return $interiorFeature;
        }

        /*
        * Restore the given item with given id (after soft delete)
        *
        * @param $id Id of the item to be restored
        *
        * @return App\\InteriorFeature
        */
        public function restoreInteriorFeature($id)
        {
            $interiorFeature = InteriorFeature::find($id);
                $interiorFeature->is_deleted = false;
                $interiorFeature->save();
                    return $interiorFeature;
        }

    }    