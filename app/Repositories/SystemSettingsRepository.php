<?php

    namespace App\Repositories;

    use App\SystemSettings as SystemSettings;
    use Prettus\Repository\Eloquent\BaseRepository;

    class SystemSettingsRepository extends BaseRepository{

        /**
         * Specify Model class name
         *
         * @return string
         */
        function model()
        {
            return "App\\SystemSettings";
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

            $propertyStatusObject = SystemSettings::select('meta_key', 'meta_value')
                                    ->where(
                                        [
                                            'meta_key'=>$metaKey
                                        ]
                                    );

            return $propertyStatusObject->first()->toArray();

        }

    }    