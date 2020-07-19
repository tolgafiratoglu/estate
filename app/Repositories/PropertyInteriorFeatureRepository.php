<?php

    namespace App\Repositories;

    use App\PropertyInteriorFeature as PropertyInteriorFeature;
    use Prettus\Repository\Eloquent\BaseRepository;

    class PropertyInteriorFeatureRepository extends BaseRepository
    {

        /**
         * Specify Model class name
         *
         * @return string
         */
        function model()
        {
            return "App\\PropertyInteriorFeature";
        }

    }    