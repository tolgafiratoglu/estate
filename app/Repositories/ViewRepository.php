<?php

    namespace App\Repositories;

    use App\View as View;
    use Prettus\Repository\Eloquent\BaseRepository;

    class ViewRepository extends BaseRepository
    {

        /**
         * Specify Model class name
         *
         * @return string
         */
        function model()
        {
            return "App\\View";
        }

        public function getPropertyViews($propertyId)
        {
            return View::select('view.id', 'view.title')
                        ->leftJoin('property_view', 'property_view.view', '=', 'view.id')
                        ->leftJoin('property', 'property.id', '=', 'property_view.property')
                        ->where(["property.id" => $propertyId])
                        ->get()->toArray();
        }

    }    