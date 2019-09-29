<?php

/* My References shortcode for displaying references */
function my_references_my_references_shortcode($atts) {
  /* Shortcode Attributes:
      showTitle: Shows reference's title (default: no)
      showImage: Shows reference's image (default: yes)
      animation: References animation type (default: carousel)
      number: Number of references to show (default: -1)
  */
  $attributes = shortcode_atts( array(
    'show-title'  => 'no',
    'show-image'  => 'yes',
    'animation'   => 'carousel',
    'number'      => -1,
    'image-style' => 'thumbnail',
    'classes'     => '',
  ), $atts, 'my-references' );

  /* Get references */
  $output = get_references(
              $attributes['show-title'],
              $attributes['show-image'],
              $attributes['animation'],
              $attributes['number'],
              $attributes['image-style'],
              $attributes['classes']);

  return $output;
}
add_shortcode('my-references', 'my_references_my_references_shortcode');
/* My References shortcode for displaying references */
