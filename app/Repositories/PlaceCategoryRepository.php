<?php

    namespace App\Repositories;

    use App\PlaceCategory as PlaceCategory;
    use Prettus\Repository\Eloquent\BaseRepository;

    class PlaceCategoryRepository extends BaseRepository
    {

        /**
         * Specify Model class name
         *
         * @return string
         */
        function model()
        {
            return "App\\PlaceCategory";
        }

        /*
        * Returns list count
        *
        *
        * @return integer
        */
        public function getPlaceCategoryListCount($deleted = false) 
        {
            return PlaceCategory::count();                                   
        }                            

        /*
        * Returns filtered list count
        *
        * @param $keyword 
        *
        * @return integer
        */
        public function getPlaceCategoryCount($keyword = NULL) 
        {

            $placeObject = PlaceCategory::findAll();

            if($keyword != NULL){
                $placeObject = PlaceCategory::where('title', 'like', '%'.$keyword.'%');
            }

            return $placeObject->count();       

        }

        /*
        * Returns item by item id
        *
        * @param $itemId Id of the item
        *
        * @return array
        */
        public function getPlaceCategory($itemId) 
        {

            $placeObject = PlaceCategory::select('id', 'title')
                                    ->where(
                                        [
                                            'id'=>$itemId
                                        ]
                                    );

            return $placeObject->first()->toArray();

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
        public function getPlaceCategoryList($offset = NULL, $limit = NULL, $orderBy = NULL, $order = NULL, $keyword = NULL) 
        {

            $placeObject = PlaceCategory::select('id', 'title');

                if($keyword != NULL){
                    $placeObject = $placeObject->where('title', 'like', '%'.$keyword.'%');
                }

                // If offset is defined:
                if($offset != NULL){
                    $placeObject = $placeObject->offset($offset);
                }

                // If limit is defined:
                if($limit != NULL){
                    $placeObject = $placeObject->limit($limit);
                }

                if($order != NULL){
                    $placeObject = $placeObject->orderBy($orderBy, $order);
                }


            return $placeObject->get()->toArray();

        }

        /*
        * Saves with given arguments
        *
        * @param $title title of the item
        *
        * @return App\\Place
        */
        public function savePlaceCategory($title, $lat, $lon)
        {
            return Place::create(["title"=>$title]);
        }

        /*
        * Saves with given arguments
        *
        * @param $id Id of the item
        * @param $title title of the item
        *
        * @return App\\Place
        */
        public function updatePlaceCategory($id, $title)
        {
            return Place::where("id", $id)->update(["title"=>$title]);
        }

        /*
        * Deletes the item from the database
        *
        * @param $id Id of the item to be removed
        *
        * @return boolean
        */
        public function deletePlace($id)
        {
            $isDeleted = Place::where('id', $id)->delete();
                return $isDeleted;
        }


    }    