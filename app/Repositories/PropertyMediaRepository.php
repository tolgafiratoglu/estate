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

        public function getPropertyMedia($propertyId)
        {
            $imagesObject = PropertyMedia::select(
                                                    'media.folder AS folder', 
                                                    'media.name AS file_name'
                                                   )
                                ->leftJoin('property', 'property_media.property', '=', 'property.id')
                                ->leftJoin('media', 'property_media.media', '=', 'media.id')
                                ->where('property.id', '=', $propertyId);

            if($imagesObject != NULL){
                return $imagesObject->get()->toArray();                                                    
            } else {
                return NULL;
            }

        }

    }    