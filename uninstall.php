<?php

if(! defined('WP_UNINSTALL_PLUGIN')){
    die(); 
}

$base_uninstall = get_post( 
    array(
        'post_type'=> 'base',
         'numberposts'=>-1,
        ));

foreach ($base_uninstall as $base_item) {
    wp_delete_post($base_item->ID, true);
    
}