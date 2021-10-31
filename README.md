# base-plugin part -1

<?php
/**
 * @package  base-based-filter
 */
/*
Plugin Name: Base
Plugin URI: http://wppool.dev
Description: Base plugin for Initial Work.
Version: 1.0.0
Author: WPPOOL
Author URI: http://wppool.dev
Requires at least: 5.0
Requires PHP:      5.4
License:           GPL-2.0+
License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain: base
 */

/*

This program is free software. But you can not redistribute it and/or modify it under the terms of the GNU General Public License
as published by the WPPOOL; either version 2 of the liense, or (at your option) ant later version.

Copyright 2021 WPPOOL
 */


defined('ABSPATH') or die('Hey, what are you doing here? You silly human!');


class Base{

    function __construct()
    {
        add_action("plugins_loaded", array( $this, 'base_load_textdomain' ));

        add_action('init', array( $this, 'base_menus') );
    }

    function register(){

        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) ); 
        add_action( 'wp_enqueue_scripts', array( $this, 'public_enqueue' ) ); 
    }


    function activate_base()
    {
        $this->base_menus();
        // Activate::activate();
        flush_rewrite_rules();
    }



    function deactivate_base()
    {
        // Deactivate::deactivate();
        $this->base_menus();
        flush_rewrite_rules();
    }

 


    function base_load_textdomain(){
        load_plugin_textdomain('base', false,dirname(__FILE__)."languages");
    }



    public function base_menus(){

        $labels = array(

            'name'                  => _x( 'Base', 'Post type general name', 'base' ),

            'singular_name'         => _x( 'Base', 'Post type singular name', 'base' ),

            'menu_name'             => _x( 'Base', 'Admin Menu text', 'base' ),

            'name_admin_bar'        => _x( 'Base', 'Add New on Toolbar', 'base' ),

            'add_new'               => __( 'Add New', 'base' ),

            'add_new_item'          => __( 'Add New Base', 'base' ),

            'new_item'              => __( 'New Base', 'base' ),

            'edit_item'             => __( 'Edit Base', 'base' ),

            'view_item'             => __( 'View Base', 'base' ),

            'all_items'             => __( 'All Base', 'base' ),

        );

        $args = array(

            'labels'             => $labels,

            'public'             => true,

            'publicly_queryable' => true,

            'show_ui'            => true, // this thing control the view : default true

            'show_in_menu'       => true,

            'query_var'          => true,

            'rewrite'            => array( 'slug' => 'base_User_data' ),

            'capability_type'    => 'post',

            'has_archive'        => true,

            'hierarchical'       => false,

            'menu_position'      => 10, //null

            'show_in_rest'       => false,   //this thing control the view of add new option(true/false)

            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),

            'menu_icon'           => 'dashicons-code-standards',


        );

        register_post_type( __('base'), $args ); //this post type used on save user data
    }


    function admin_enqueue(){

        wp_enqueue_script( 'base_post_type_select_js', plugins_url( '/assets/base-script.js', __FILE__ ),array('jquery'),1.0,true );

        wp_enqueue_style( 'base_bootstrap_css', plugins_url( '/assets/base-style.css', __FILE__ ));
    }

    function public_enqueue(){
        //code
        wp_enqueue_script( 'base_post_type_select_js', plugins_url( '/assets/base-script.js', __FILE__ ),array('jquery'),1.0,true );

        wp_enqueue_style( 'base_bootstrap_css', plugins_url( '/assets/base-style.css', __FILE__ ));
    }



}

if(class_exists('Base')){
    $base = new Base;
    $base ->register();
}


register_activation_hook (__FILE__, array( $base, 'activate_base' ) );


register_deactivation_hook (__FILE__, array( $base, 'deactivate_base' ) );


## ==================================================================================
# base-plugin part -2 separation of class and files 

