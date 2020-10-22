<?php

    /*
    *   Returns menu item
    *   @param $menuItem array
    */
    function headerMenuItem($menuItem)
    {

        $class = 'menu-item';
            if(sizeof($menuItem["children"]) > 0){
                $class .= ' menu-item-has-children';
            }    

        $menuItemContent = '<li class="'.$class.'">';
            $menuItemContent .= '<a href="'.$menuItem['url'].'">'.$menuItem["label"].'</a>';
            // Add children with a recursive call:
            if(sizeof($menuItem["children"]) > 0){
                $menuItemContent .= '<ul class="sub-menu">';
                foreach($menuItem["children"] AS $menuChild){
                    $menuItemContent .= headerMenuItem($menuChild);
                }
                $menuItemContent .= '</ul>';
            }
        $menuItemContent .= '</li>';
        return $menuItemContent;
    }

    /*
    *    Outputs header menu
    *    @param $menuTree array
    */
    function build_header_menu($menuTree)
    {
        
        $menuOutput = '<ul id="header-menu" class="menu">';
            
            if(sizeof($menuTree) > 0){
                foreach($menuTree AS $key=>$menuItem){
                    $menuOutput .= headerMenuItem($menuItem);
                    // $menuOutput .= $menuItem["label"];
                }
            }

        $menuOutput .= '</ul>';
        return $menuOutput;

    }