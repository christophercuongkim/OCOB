<?php

///* For jQuery calling PHP Functions */
//function getSubmenu($args) {
//    echo "HI";
//    try {
//        switch_to_blog(27);
//    } catch($e) {
//        echo "HELLOO";
//        echo $e;
//    }
//    echo "HI";
//    $subMenu = wp_get_nav_menu_items(3);
//    echo $subMenu;
////    $tempArr = array();
////    for($i = 0; $i < sizeof($subMenu); $i++) {
////        array_push($tempArr, $subMenu[$i]->title);
////    }
//    $returnArray = array();
//    $returnArray["result"] = $subMenu->title;
////    restore_current_blog();
//    return $returnArray;
//}
//

require_once("../../../wp-load.php");
if($_POST) {
    switch($_POST["functionname"]) {
        case 'getSubmenu':
            echo json_encode(getSubMenuList($_POST["arguments"]));
        break;
    }
}

function getSubMenuList($url) {
    if(substr($url, -1) != "/") {
        $url .= "/";
    }
    $returnArr = array();
    $blogID = get_blog_id_from_url( "/", $url );
    if($blogID == 0) {
        $postid =  url_to_postid( $url );
        $menuID = get_field("sidebarSelectArea", $postid);
        if($menuID == "INHERIT_FROM_PARENT") {
            $menuID =  get_bloginfo();
        }
        $items = wp_get_nav_menu_items($menuID);
        foreach($items as $item) {
            $tempItem = array();
            $tempItem["url"] = $item->url;
            $tempItem["title"] = $item->title;
            array_push($returnArr, $tempItem);
        }
        return $returnArr; 
    } else {
        switch_to_blog($blogID);

        $postid = get_option( 'page_on_front' );
        $menuID = get_field("sidebarSelectArea", $postid);
        if($menuID == "INHERIT_FROM_PARENT") {
            $menuID =  get_bloginfo();
        }
        $items = wp_get_nav_menu_items($menuID);
        foreach($items as $item) {
            $tempItem = array();
            $tempItem["url"] = $item->url;
            $tempItem["title"] = $item->title;
            array_push($returnArr, $tempItem);
        }
        restore_current_blog();
        return $returnArr; 
    }
}
//getSubMenuList("/studentservices/");

?>
