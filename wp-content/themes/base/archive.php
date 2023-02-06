<?php

/*------------------------------------------------------------------------
* Archive
*
* Template part is used to display an archive page.
------------------------------------------------------------------------*/

$context = Timber::context();

// If Archive page
if ( is_post_type_archive() ) {
    $context['archive_title'] = post_type_archive_title( '', false );
} elseif ( is_tax() ) {
    $context['archive_title'] = single_cat_title( '', false );
} elseif ( is_category() ) {
    $context['archive_title'] = single_cat_title( '', false );
} else {
    $context['archive_title'] = 'Archive';
}

$context['posts'] = new Timber\PostQuery();

Timber::render( array( 'archive-' . get_post_type() . '.twig', 'archive.twig', 'index.twig' ), $context );
