<?php

/*------------------------------------------------------------------------
* Template for displaying single posts.
------------------------------------------------------------------------*/

$context = Timber::context();

$post = new Timber\Post();
$context['post'] = $post;

Timber::render( array( 'tpl-singles/single-' . $post->ID . '.twig', 'tpl-singles/single-' . $post->post_type . '.twig', 'tpl-singles/single.twig' ), $context );
