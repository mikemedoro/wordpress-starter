<?php

/*------------------------------------------------------------------------
Setup theme defaults
------------------------------------------------------------------------*/

// Helper modules from the Roots Soil plugin
include_once get_template_directory() . '/includes/plugins/soil.php';

// Disable the admin toolbar
// show_admin_bar( false );

// Add title tag theme support
add_theme_support( 'title-tag' );

// Add post thumbnails support
add_theme_support( 'post-thumbnails' );

// Declare custom image sizes
add_image_size( 'hidef', 1920, 0, false );
add_image_size( '2xlarge', 1600, 0, false );
add_image_size( 'xlarge', 1366, 0, false );

remove_image_size( '1536x1536' );
remove_image_size( '2048x2048' );

// Add HTML5 theme support
add_theme_support( 'html5', array(
  'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
) );

// Register navigation menus
register_nav_menus( [
  'primary-menu' => __( 'Primary Navigation', 'base_theme' ),
  'footer-menu' => __( 'Footer Navigation', 'base_theme' ),
] );

// Use main stylesheet for visual editor
add_editor_style( get_template_directory_uri() . '/dist/styles/app.css' );
