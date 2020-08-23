<?php

    /*
    *   Returns menu item
    *   @param $menuItem array
    */
    function headerMenuItem($menuItem)
    {
        $menuItemContent = '<li class="menu-item">';
            $menuItemContent .= '<a href="'.$menuItem['url'].'">'.$menuItem["label"].'</a>';
            // Add children with a recursive call:
            if(sizeof($menuItem["children"]) > 0){
                foreach($menuItem["children"] AS $menuChild){
                    $menuOutput .= headerMenuItem($menuChild);
                }
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

            /*
            $menuOutput .= '<li id="menu-item-34" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-has-children menu-item-34"><a href="http://themes.qualstudio.com/artifex/">Layouts</a>
            <ul class="sub-menu">
            <li id="menu-item-35" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-has-children menu-item-35"><a href="http://themes.qualstudio.com/artifex/">Classic View</a>
            <ul class="sub-menu">
            <li id="menu-item-225" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-225"><a href="http://themes.qualstudio.com/artifex/">With Sidebar</a></li>
            <li id="menu-item-224" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-224"><a href="http://themes.qualstudio.com/artifex/219-2/">Without Sidebar</a></li>
            </ul>
            </li>';
            */
        $menuOutput .= '</ul>';
        return $menuOutput;
    }