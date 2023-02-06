<?php

/*------------------------------------------------------------------------
* Posts Page
*
* Template page is used to display latest posts set in the
* front page displays section.
------------------------------------------------------------------------*/

$context = Timber::context();

$post = new Timber\Post();

$context['post'] = $post;

Timber::render( array( 'tpl-pages/page-blog.twig', 'index.twig' ), $context );
