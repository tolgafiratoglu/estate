<?php

    namespace App\Repositories;

    use App\Property as Property;
    use Prettus\Repository\Eloquent\BaseRepository;

    class PropertyRepository extends BaseRepository{

        /**
         * Specify Model class name
         *
         * @return string
         */
        function model()
        {
            return "App\\Property";
        }

        /*
        * Minimum area for any given field:
        * @return integer
        */
        public function getMinValue($field)
        {
            return Property::min($field);
        }

        /*
        * Maximum value for any given field
        * @return integer
        */
        public function getMaxValue($field)
        {
            return Property::max($field);
        }

    }
    
?>    