<?php

    namespace App\Repositories;

    use App\PropertyMedia;
    use Prettus\Repository\Eloquent\BaseRepository;

    class PropertyMediaRepository extends BaseRepository
    {

        /**
         * Specify Model class name
         *
         * @return string
         */
        function model()
        {
            return "App\\PropertyMedia";
        }

    }    