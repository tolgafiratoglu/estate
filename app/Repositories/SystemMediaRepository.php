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

            $settingsObject = SystemMedia::select('media.name AS media_name', 'media.folder AS media_folder')
                                    ->leftJoin('media', 'media.id', '=', 'system_media.media')
                                    ->where(
                                        [
                                            'system_media.meta_key'=>$metaKey
                                        ]
                                    );

            if($settingsObject->first() != NULL){                        
                
                $mediaFolder = $settingsObject->first()->toArray()["media_folder"];
                $mediaName = $settingsObject->first()->toArray()["media_name"];

                if($mediaName != NULL){
                    return asset($mediaFolder.$mediaName);
                } else {
                    return NULL;
                }

            } else {
                return NULL;
            }

        }

    }    