<?php

/*------------------------------------------------------------------------
Theme helper functions
------------------------------------------------------------------------*/

// Parse a video URI/URL to determine video type/source and the video id
function parse_video_uri( $url ) {
  // Parse the URL
  $parse = parse_url( $url );

  // Set blank variables
  $video_type = '';
  $video_id = '';

  // URL is http://youtu.be/xxxx
  if ( $parse['host'] == 'youtu.be' ) {
    $video_type = 'youtube';
    $video_id = ltrim( $parse['path'],'/' );
  }

  // URL is http://www.youtube.com/watch?v=xxxx
  // or http://www.youtube.com/watch?feature=player_embedded&v=xxx
  // or http://www.youtube.com/embed/xxxx
  if ( ( $parse['host'] == 'youtube.com' ) || ( $parse['host'] == 'www.youtube.com' ) ) {
    $video_type = 'youtube';
    parse_str( $parse['query'] );
    $video_id = $v;

    if ( !empty( $feature ) )
      $video_id = end( explode( 'v=', $parse['query'] ) );

    if ( strpos( $parse['path'], 'embed' ) == 1 )
      $video_id = end( explode( '/', $parse['path'] ) );
  }

  // URL is http://www.vimeo.com
  if ( ( $parse['host'] == 'vimeo.com' ) || ( $parse['host'] == 'www.vimeo.com' ) ) {
    $video_type = 'vimeo';
    $video_id = ltrim( $parse['path'],'/' );
  }

  if ( ( $parse['host'] == 'player.vimeo.com' ) ) {
    $video_type = 'vimeo';
    $video_id = ltrim( $parse['path'],'/video/' );
  }

  $host_names = explode(".", $parse['host'] );
  $rebuild = ( ! empty( $host_names[1] ) ? $host_names[1] : '') . '.' . ( ! empty($host_names[2] ) ? $host_names[2] : '');

  // If recognized type return video array
  if ( !empty( $video_type ) ) {
    $video_array = array(
      'type' => $video_type,
      'id' => $video_id
    );
    return $video_array;
  } else {
    return false;
  }
}


// Related posts function
function get_related_posts( $post_id, $related_count, $args = array() ) {
  $args = wp_parse_args( (array) $args, array(
    'orderby' => 'rand',
    'return'  => 'query', // Valid values are: 'query' (WP_Query object), 'array' (the arguments array)
  ) );

  $related_args = array(
    'post_type'      => get_post_type( $post_id ),
    'posts_per_page' => $related_count,
    'post_status'    => 'publish',
    'post__not_in'   => array( $post_id ),
    'orderby'        => $args['orderby'],
    'tax_query'      => array()
  );

  $post = get_post( $post_id );
  $taxonomies = get_object_taxonomies( $post, 'names' );

  foreach ( $taxonomies as $taxonomy ) {
    $terms = get_the_terms( $post_id, $taxonomy );

    if ( empty( $terms ) ) {
      continue;
    }

    $term_list = wp_list_pluck( $terms, 'slug' );

    $related_args['tax_query'][] = array(
      'taxonomy' => $taxonomy,
      'field'    => 'slug',
      'terms'    => $term_list
    );
  }

  if ( count( $related_args['tax_query'] ) > 1 ) {
    $related_args['tax_query']['relation'] = 'OR';
  }

  if ( $args['return'] == 'query' ) {
    return new WP_Query( $related_args );
  } else {
    return $related_args;
  }
}
