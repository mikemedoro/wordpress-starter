<?php

/*------------------------------------------------------------------------
* Main Index
*
* Template part is used to display a page when nothing more specific
* matches a query. It will put together the home page if no home.php
* file exists.
------------------------------------------------------------------------*/

$context = Timber::context();

$context['posts'] = new Timber\PostQuery();

Timber::render( 'index.twig', $context );
