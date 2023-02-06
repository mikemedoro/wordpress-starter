<?php

/*------------------------------------------------------------------------
ACF settings
------------------------------------------------------------------------*/

// Hide ACF menu from users unless admin
add_filter( 'acf/settings/show_admin', function( $show ) {
    $current_user = wp_get_current_user();

    if( current_user_can('manage_options') AND $current_user->user_nicename == 'admin' ) {
        return true;
    } else {
        return false;
    }
} );


// Add message if acf pro key is defined in functions.php
// add_filter( 'acf/admin/license_key_constant_message', function( $message ) {
//     return 'ACF is activated by a defined license key.';
// } );


// Add drag and drop support to field groups
add_post_type_support( 'acf-field-group', 'page-attributes' );


// Setup Options page
if( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page(array(
        'page_title' 	=> 'Theme Settings',
        'menu_title'	=> 'Theme Settings',
        'menu_slug' 	=> 'theme-settings',
        'capability'	=> 'edit_posts'
    ) );
}


// Add custom WYSIWYG toolbars
add_filter( 'acf/fields/wysiwyg/toolbars', function( $toolbars ) {
    $toolbars['Standard'] = array();
    $toolbars['Standard'][1] = array( 'styleselect', 'bold', 'italic', 'link', 'bullist', 'numlist', 'hr', 'removeformat', 'pastetext' );

    $toolbars['Simple'] = array();
    $toolbars['Simple'][1] = array( 'bold', 'italic' , 'link', 'bullist', 'numlist', 'removeformat', 'pastetext' );

    return $toolbars;
} );


// Set image field sizing
add_action('acf/input/admin_head', function() {
    ?>
    <style type="text/css">
        .acf-field-image[data-name='logo'] .image-wrap,
        .acf-field-image[data-name='icon'] .image-wrap {
            max-width: 200px !important;
        }

        .acf-field-image[data-name='logo'] .image-wrap img,
        .acf-field-image[data-name='icon'] .image-wrap img {
            -o-object-fit: contain;
            object-fit: contain;
        }
    </style>
    <?php
} );
