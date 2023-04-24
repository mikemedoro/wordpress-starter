<?php

/*------------------------------------------------------------------------
Yoast SEO settings
------------------------------------------------------------------------*/

// Move meta box to bottom of screen
add_filter( 'wpseo_metabox_prio', function() {
  return 'low';
} );
