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


    function register(){

        add_action("plugins_loaded", array( $this, 'base_load_textdomain' ));
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) ); 
        add_action( 'wp_enqueue_scripts', array( $this, 'public_enqueue' ) ); 


        //custom page 
        add_action("admin_menu", array($this, 'add_admin_pages'));
    }

    protected function create_post_type(){
        add_action('init', array( $this, 'base_menus') );
    }


    function base_load_textdomain(){
        load_plugin_textdomain('base', false,dirname(__FILE__)."languages");
    }

    public function add_admin_pages(){

        // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
        add_menu_page( 
            'Custom Menu Page Title', //page
            'Custom Menu Page',  //title
            'manage_options', //capa
            'base_plugin', //slug
            array($this, 'base_pages'),//function 
            'dashicons-welcome-widgets-menus',
                90 );
    }


    public function base_pages()
    {
        require_once plugin_dir_path(__FILE__).'template/base-page.php';
    }


    function base_menus(){

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


    function activate(){ //function name that used below
        //require as its others used
        require_once plugin_dir_path(__FILE__).'inc/base-activate.php';
        BaseActivate::activate();
    }

    function deactivate(){
        require_once plugin_dir_path(__FILE__).'inc/base-deactivate.php';
        Basedeactivate::deactivate(); 
    }



}


if(class_exists('Base')){
    $base = new Base;
    $base ->register();
}




register_activation_hook (__FILE__, array( $base, 'activate' ) ); // class instantiate obj name , function name function name // this is calling directly 

register_deactivation_hook (__FILE__, array( $base, 'deactivate' ) ); // class instantiate  obj name , static function name


require_once plugin_dir_path(__FILE__).'inc/CPT.php';