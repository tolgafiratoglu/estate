<?php

    namespace App\Repositories;

    use App\PropertyView as PropertyView;
    use Prettus\Repository\Eloquent\BaseRepository;

    class PropertyViewRepository extends BaseRepository
    {

        /**
         * Specify Model class name
         *
         * @return string
         */
        function model()
        {
            return "App\\PropertyView";
        }

    }    