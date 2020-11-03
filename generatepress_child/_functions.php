<?php
/**
 * GeneratePress child theme functions and definitions.
 *
 * Add your custom PHP in this file. 
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */

function generatepress_child_enqueue_scripts() {
	if ( is_rtl() ) {
		wp_enqueue_style( 'generatepress-rtl', trailingslashit( get_template_directory_uri() ) . 'rtl.css' );
	}
}

//function bootstrapstarter_enqueue_styles() {
//    wp_register_style('bootstrap', get_theme_file_uri('/css/grid.min.css' ));
//    $dependencies = array('bootstrap');
//    wp_enqueue_style( 'bootstrapstarter-style',  get_theme_file_uri('/css/grid.min.css' ), $dependencies ); 
//}

//function bootstrapstarter_enqueue_scripts() {
//    $dependencies = array('jquery');
//    wp_enqueue_script('bootstrap', get_theme_file_uri('/js/bootstrap.min.js'), $dependencies, '3.3.6', true );
//}

add_action( 'wp_enqueue_scripts', 'generatepress_child_enqueue_scripts', 100 );
//add_action( 'wp_enqueue_scripts', 'bootstrapstarter_enqueue_styles' );
//add_action( 'wp_enqueue_scripts', 'bootstrapstarter_enqueue_scripts' );