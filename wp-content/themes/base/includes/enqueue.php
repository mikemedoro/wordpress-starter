<?php

/*------------------------------------------------------------------------
Enqueue scripts and styles
------------------------------------------------------------------------*/

// Include theme styles
$stylesheet = '/dist/styles/app.css';
if ( file_exists( get_template_directory().$stylesheet ) ) {
  wp_enqueue_style( 'styles', get_template_directory_uri() . $stylesheet.'?cache=' . filemtime( get_template_directory() . $stylesheet ) );
}

// Include Typekit
// wp_enqueue_style( 'typekit', 'https://use.typekit.net/xxxxxx.css' );

// Dequeue unused WordPress styles
wp_dequeue_style( 'global-styles' );
wp_dequeue_style( 'classic-theme-styles' );

// Replace default version of = jQuery that WordPress installs
if ( ! is_admin() ) {
  wp_deregister_script( 'jquery' );

  wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js', array(), false, true );
}

// Include scripts
$scripts = '/dist/scripts/app.js';
if ( file_exists( get_template_directory().$scripts ) ) {
  wp_register_script( 'scripts', get_template_directory_uri() . $scripts . '?cache=' . filemtime( get_template_directory() . $scripts ), array('jquery'), false, true );
  wp_enqueue_script( 'scripts' );
}

// Remove dashicons for non logged-in users
if ( ! is_user_logged_in() ) {
  wp_deregister_style( 'dashicons' );
}
