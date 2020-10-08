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
        public function getSetting($context, $metaKey) 
        {

            $settingsObject = SystemSettings::select('meta_key', 'meta_value')
                                    ->where(
                                        [
                                            'context'=>$context,
                                            'meta_key'=>$metaKey
                                        ]
                                    );

                if($settingsObject->first() != NULL){                        
                    $setting = $settingsObject->first()->toArray();
                    return $setting["meta_value"];
                } else {
                    return NULL;
                }

        }

    }    