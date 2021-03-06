<?php

    namespace App\Repositories;

    use App\SystemDefaults as SystemDefaults;
    use Prettus\Repository\Eloquent\BaseRepository;

    class SystemDefaultsRepository extends BaseRepository{

        /**
         * Specify Model class name
         *
         * @return string
         */
        function model()
        {
            return "App\\SystemDefaults";
        }

        /*
        * Returns meta_value for a given meta_key
        *
        * @param $meta_key Meta key
        *
        * @return array
        */
        public function getSettingsByContext($context) 
        {

            $settingsObject = SystemDefaults::select('meta_key', 'meta_value')
                                    ->where(
                                        [
                                            'context'=>$context
                                        ]
                                    );

                if($settingsObject->get() != NULL)
                {         
                    $settings = $settingsObject->get()->toArray();
                    return getSettingCollection($settings);
                } else {
                    return NULL;
                }

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

            $settingsObject = SystemDefaults::select('meta_key', 'meta_value')
                                    ->where(
                                        [
                                            'context'=>$context,
                                            'meta_key'=>$metaKey
                                        ]
                                    );

            if($settingsObject->first() != NULL){                        
                return $settingsObject->first()->toArray()["meta_value"];
            } else {
                return NULL;
            }

        }

    }    