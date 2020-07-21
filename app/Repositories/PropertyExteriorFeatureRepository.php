<?php

    namespace App\Repositories;

    use App\PropertyExteriorFeature as PropertyExteriorFeature;
    use Prettus\Repository\Eloquent\BaseRepository;

    class PropertyExteriorFeatureRepository extends BaseRepository
    {

        /**
         * Specify Model class name
         *
         * @return string
         */
        function model()
        {
            return "App\\PropertyExteriorFeature";
        }

    }    