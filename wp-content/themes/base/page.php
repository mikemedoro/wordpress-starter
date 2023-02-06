<?php

/*------------------------------------------------------------------------
* Template that displays all pages by default.
------------------------------------------------------------------------*/

$context = Timber::context();

$post = new Timber\Post();
$context['post'] = $post;

Timber::render( array( 'tpl-pages/page-' . $post->post_name . '.twig', 'tpl-pages/tpl-' . $post->post_name . '.twig', 'tpl-pages/page.twig' ), $context );
