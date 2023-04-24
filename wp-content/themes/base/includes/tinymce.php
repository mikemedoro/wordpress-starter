<?php

/*------------------------------------------------------------------------
TinyMCE custimizations
------------------------------------------------------------------------*/

// Turn on "paste as plain text" by default
add_filter( 'tiny_mce_before_init', function( $init ) {
  $init['paste_as_text'] = true;
  return $init;
} );


// Add styles/classes to the Styles select menu
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
