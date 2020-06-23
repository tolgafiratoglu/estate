<?php

    namespace App\Repositories;

    use App\User;
    use Prettus\Repository\Eloquent\BaseRepository;

    class UserRepository extends BaseRepository{

        /**
         * Specify Model class name
         *
         * @return string
         */
        function model()
        {
            return "App\\User";
        }
        
    }
    
?>    