<?php

/*------------------------------------------------------------------------
Admin custimizations
------------------------------------------------------------------------*/

// Customize login screen
add_filter( 'login_headerurl', function() {
    return home_url();
} );

add_filter( 'login_headertext', function() {
    return get_bloginfo('name');
} );

add_action( 'login_enqueue_scripts', function() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/dist/images/logo.svg);
            background-repeat: no-repeat;
            background-position: center center;
            background-size: contain;
            height: 80px;
            width: 320px;
        }
    </style>
<?php } );


// Make login logo wider
add_action( 'login_enqueue_scripts', function() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            width: 250px;
        }
    </style>
<?php } );


// Remove pages from admin menu
add_action( 'admin_menu', function() {
    remove_menu_page( 'edit-comments.php' );
    remove_submenu_page( 'themes.php', 'theme-editor.php' );
    remove_submenu_page( 'plugins.php', 'plugin-editor.php' );

    $current_user = wp_get_current_user();

    if( $current_user->user_nicename != 'admin' ) {
        remove_menu_page( 'plugins.php' );
    }
}, 999 );


// Removes items from admin bar
add_action( 'wp_before_admin_bar_render', function() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'wp-logo' );
    $wp_admin_bar->remove_menu( 'updates' );
    $wp_admin_bar->remove_menu( 'new-content' );
    $wp_admin_bar->remove_menu( 'comments' );
} );


// Disable auto update notification emails for plugins
add_filter( 'auto_plugin_update_send_email', '__return_false' );


/**
 * By default, in Add/Edit Post, WordPress moves checked categories to the top of the list and unchecked to the bottom.
 * When you have subcategories that you want to keep below their parents at all times, this makes no sense.
 */
add_filter( 'wp_terms_checklist_args', function( $args ) {
	$args['checked_ontop'] = false;
	return $args;
} );


// Make login logo wider. Logo is set in plate.php
add_action( 'login_enqueue_scripts', function() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            width: 250px;
        }
    </style>
<?php } );


// Use main stylesheet for visual editor
add_action('admin_init', function() {
    add_editor_style( get_template_directory_uri() . '/dist/styles/app.css' );
} );


// Load admin styles
$stylesheet = get_template_directory() . '/dist/styles/admin.css';
if ( is_admin() && file_exists( get_template_directory() . $stylesheet ) ) {
    wp_enqueue_style( 'admin_styles', get_template_directory_uri() . $stylesheet . '?cache=' . filemtime( $stylesheet ) );
}


// Remove tags from posts
unregister_taxonomy_for_object_type( 'post_tag', 'post' );


// Remove comment functionality for all post types
add_action( 'admin_init', function() {
    $post_types = get_post_types();
    foreach ( $post_types as $post_type ) {
        if( post_type_supports( $post_type,'comments' ) ) {
            remove_post_type_support( $post_type,'comments' );
            remove_post_type_support( $post_type,'trackbacks' );
        }
    }
} );


// TinyMCE: Turn on "paste as plain text" by default
add_filter( 'tiny_mce_before_init', function( $init ) {
    $init['paste_as_text'] = true;
    return $init;
} );


// TinyMCE: Add styles/classes to the Styles select menu
add_filter( 'tiny_mce_before_init', function( $formats ) {
    $style_formats = array(
        // array(
        //     'title' => 'Heading 1',
        //     'block' => 'h1',
        // ),
        array(
            'title' => 'Heading 2',
            'block' => 'h2',
        ),
        array(
            'title' => '- Heading 3',
            'block' => 'h3',
        ),
        array(
            'title' => '-- Heading 4',
            'block' => 'h4',
        ),
        array(
            'title' => '--- Heading 5',
            'block' => 'h5',
        ),
        array(
            'title' => 'Paragraph',
            'block' => 'p',
        ),
        array(
            'title' => 'Text Styles',
            'items' => array(
                array(
                    'title' => 'Kicker Heading',
                    'block' => 'div',
                    'classes' => 'kicker',
                ),
                array(
                    'title' => 'Lead Paragraph',
                    'block' => 'p',
                    'classes' => 'lead',
                ),
                array(
                    'title' => 'Small Paragraph',
                    'block' => 'p',
                    'classes' => 'text-sm',
                ),
                array(
                    'title' => 'Quote',
                    'block' => 'blockquote',
                    'classes' => 'blockquote',
                ),
                array(
                    'title' => "Button",
                    'selector' => 'a',
                    'classes' => 'btn'
                )
            )
        )
    );

    $formats['style_formats'] = json_encode( $style_formats );

    unset($formats['preview_styles']);

    return $formats;
} );
