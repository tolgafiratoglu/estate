<?php

    namespace App\Repositories;

    use App\Project as Project;
    use Prettus\Repository\Eloquent\BaseRepository;

    class ProjectRepository extends BaseRepository{

        /**
         * Specify Model class name
         *
         * @return string
         */
        function model()
        {
            return "App\\Project";
        }

        /*
        * Returns list of items defined by parameters
        *
        * @param $isDeleted if items are deleted or not
        * @param $isDrafted if items are drafted or not
        * @param $offset offset of the collection
        * @param $limit limit of the collection
        * @param $orderBy order by a field
        * @param $order sort criteria
        * @param $keyword 
        *
        * @return array
        */
        public function getProjectList($isDeleted = false, $approvalStatus = 'approved', $isDrafted = false, $offset = NULL, $limit = NULL, $orderBy = NULL, $order = NULL, $keyword = NULL) 
        {

            $propertyListObject = Project::select('project.id AS id', 'project.title AS project_title', 'project.slug AS slug', 'location', 'location.name AS location_name', 'min_price', 'max_price', 'min_number_of_rooms', 'max_number_of_rooms', 'number_of_properties', 'lat', 'lon', 'approval_status', 'is_drafted', 'media.folder AS featured_image_folder', 'media.name AS feature_image_file_name')
                                            ->leftJoin('media', 'project.featured_image', '=', 'media.id')
                                            ->leftJoin('location', 'project.location', '=', 'location.id')
                                            ->join('users', 'users.id', '=', 'project.created_by')
                                            ->where(['project.is_deleted'=>$isDeleted, 'project.approval_status'=>$approvalStatus, 'project.is_drafted'=>$isDrafted])
                                                ->where(['users.is_blocked'=>false]);                                                                

                // If offset is defined:
                if($offset != NULL){
                    $propertyListObject = $propertyListObject->offset($offset);
                }

                // If limit is defined:
                if($limit != NULL){
                    $propertyListObject = $propertyListObject->limit($limit);
                }

                if($order != NULL){
                    $propertyListObject = $propertyListObject->orderBy($orderBy, $order);
                }

                if($keyword != NULL){
                    $propertyListObject = $propertyListObject->where('title', 'like', '%'.$keyword.'%');
                }

            return $propertyListObject->get()->toArray();

        }

    }
    
?>    