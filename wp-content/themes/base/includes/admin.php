<?php

/*------------------------------------------------------------------------
Admin login page customizations
------------------------------------------------------------------------*/

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
      width: 250px;
    }
  </style>
<?php } );
