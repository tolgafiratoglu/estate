<?php

    namespace App\Repositories;

    use App\SystemMedia as SystemMedia;
    use Prettus\Repository\Eloquent\BaseRepository;

    class SystemMediaRepository extends BaseRepository{

        /**
         * Specify Model class name
         *
         * @return string
         */
        function model()
        {
            return "App\\SystemMedia";
        }

        /*
        * Returns meta_value for a given meta_key
        *
        * @param $meta_key Meta key
        *
        * @return array
        */
        public function getSetting($metaKey) 
        {

            $settingsObject = SystemMedia::select('meta_key', 'media')
                                    ->where(
                                        [
                                            'meta_key'=>$metaKey
                                        ]
                                    );

            if($settingsObject->first() != NULL){                        
                return $settingsObject->first()->toArray()["media"];
            } else {
                return NULL;
            }

        }

    }    