<?php

/**
 * Get all the registered image sizes along with their dimensions
 *
 * @global array $_wp_additional_image_sizes
 *
 * @link http://core.trac.wordpress.org/ticket/18947 Reference ticket
 *
 * @return array $image_sizes The image sizes
 */
function get_all_image_sizes() {
    global $_wp_additional_image_sizes;

    $default_image_sizes = get_intermediate_image_sizes();

    foreach ( $default_image_sizes as $size ) {
        $image_sizes[ $size ][ 'width' ] = intval( get_option( "{$size}_size_w" ) );
        $image_sizes[ $size ][ 'height' ] = intval( get_option( "{$size}_size_h" ) );
        $image_sizes[ $size ][ 'crop' ] = get_option( "{$size}_crop" ) ? get_option( "{$size}_crop" ) : false;
    }

    if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) ) {
        $image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
    }

    return $image_sizes;
}

/**
 * Get posts of references
 */
function get_references($showTitle, $showImage, $animation, $number, $imageStyle) {
  $args = array(
    'numberposts' => $number,
    'post_type'   => 'reference'
  );

  $myReferences = get_posts($args);

  $output = '<div class="row">';

  if($myReferences) {
    foreach ($myReferences as $reference) :
      $referenceID = $reference->ID;
      $referenceTitle = get_the_title($referenceID);
      $referenceImage = get_the_post_thumbnail($referenceID, $imageStyle);
      $referenceWebSite = get_post_meta($referenceID, 'web-site', true);
      $output .= '<div class="col-md-3">';
      if($referenceWebSite) $output .= '<a href="'.$referenceWebSite.'" target="_blank">';
      if($showImage == 'yes') $output .= $referenceImage;
      if($showTitle == 'yes') $output .= $referenceTitle.$imageStyle;
      if($referenceWebSite) $output .= '</a>';
      $output .= '</div>';
    endforeach;
    wp_reset_postdata();
  }

  $output .= '</div>';

  return $output;
}
