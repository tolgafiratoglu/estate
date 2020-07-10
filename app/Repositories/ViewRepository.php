<?php

    namespace App\Repositories;

    use App\ExteriorFeature as ExteriorFeature;
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

    }    