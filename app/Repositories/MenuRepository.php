<?php

    namespace App\Repositories;

    use App\Menu as Menu;
    use Prettus\Repository\Eloquent\BaseRepository;

    class MenuRepository extends BaseRepository
    {

        /**
         * Specify Model class name
         *
         * @return string
         */
        function model()
        {
            return "App\\Menu";
        }

        public function getMenuTree($context, $parentId)
        {

            $menuTree = [];

            $menuItems = Menu::select('id', 'context', 'label', 'target', 'custom_url', 'parent', 'property')
                        ->where(["context" => $context, "parent"=>$parentId])
                        ->get()->toArray();
        
        
            if(sizeof($menuItems) > 0)
            {

                foreach($menuItems AS $menuItem)
                {

                    $menuId = $menuItem["id"];

                    $children = $this->getMenuTree($context, $menuId);

                    $menuTree[] = [
                        "id"=>$menuItem["id"],
                        "label"=>$menuItem["label"],
                        "url"=>$menuItem["custom_url"],
                        "children"=>$children,
                    ];

                    

                }

            }

            return $menuTree;

        }

    }    