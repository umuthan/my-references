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
    'show_title'  => 'no',
    'show_image'  => 'yes',
    'animation'   => 'carousel',
    'number'      => -1,
    'image_style' => 'thumbnail'
  ), $atts, 'my-references' );

  /* Get references */
  $output = get_references(
              $attributes['show_title'],
              $attributes['show_image'],
              $attributes['animation'],
              $attributes['number'],
              $attributes['image_style']);

  return $output;
}
add_shortcode('my-references', 'my_references_my_references_shortcode');
/* My References shortcode for displaying references */
