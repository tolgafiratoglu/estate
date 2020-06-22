<?php

    namespace App\Repositories;

    use App\SystemLimits as SystemLimits;
    use Prettus\Repository\Eloquent\BaseRepository;

    class SystemLimitsRepository extends BaseRepository{

        /**
         * Specify Model class name
         *
         * @return string
         */
        function model()
        {
            return "App\\SystemLimits";
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

            $settingsObject = SystemLimits::select('meta_key', 'meta_value')
                                    ->where(
                                        [
                                            'meta_key'=>$metaKey
                                        ]
                                    );

            if($settingsObject->first() != NULL){                        
                return $settingsObject->first()->toArray();
            } else {
                return NULL;
            }

        }

    }    