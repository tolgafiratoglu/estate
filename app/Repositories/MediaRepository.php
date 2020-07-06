<?php

    namespace App\Repositories;

    use App\Media as Media;
    use Prettus\Repository\Eloquent\BaseRepository;

    class MediaRepository extends BaseRepository{

        /**
         * Specify Model class name
         *
         * @return string
         */
        function model()
        {
            return "App\\Media";
        }

    }    