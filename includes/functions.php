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
function get_references($showTitle, $showImage, $animation, $number, $imageStyle, $classes) {
  $args = array(
    'numberposts' => $number,
    'post_type'   => 'reference'
  );

  $myReferences = get_posts($args);

  if($animation=='carousel') $output = '<div class="my-references-animation-carousel">';
  else $output = '';

  if($myReferences) {
    foreach ($myReferences as $reference) :
      $referenceID = $reference->ID;
      // Reference Title
      $referenceTitle = get_the_title($referenceID);
      // Reference Image defined as featured image in reference
      $referenceImage = get_the_post_thumbnail($referenceID, $imageStyle);
      // Reference Web Site defined as web-site custom-field
      $referenceWebSite = get_post_meta($referenceID, 'web-site', true);
      // Reference Content
      $referenceContent = $reference->post_content;
      // Reference Permalink
      $referencePermalink = get_the_permalink($referenceID);
      if($animation == 'carousel') $output .= '<div class="my-references-carousel-item">';
      else {
        if($classes) $class = ' class="'.$classes.'"';
        else $class = '';
        $output .= '<div'.$class.'>';
      }
      if($referenceWebSite) $output .= '<a href="'.$referenceWebSite.'" target="_blank" rel="nofollow">';
      else if($referenceContent) $output .= '<a href="'.$referencePermalink.'">';
      if($showImage == 'yes') $output .= $referenceImage;
      if($showImage == 'yes' && $showTitle == 'yes') {
        $output .= '</a><br />';
        if($referenceWebSite) $output .= '<a href="'.$referenceWebSite.'" target="_blank" rel="nofollow">';
        else if($referenceContent) $output .= '<a href="'.$referencePermalink.'">';
      }
      if($showTitle == 'yes') $output .= $referenceTitle;
      if($referenceWebSite) $output .= '</a>';
      else if($referenceContent) $output .= '</a>';
      $output .= '</div>';
    endforeach;
    wp_reset_postdata();
  }

  if($animation=='carousel') $output .= '</div>';
  else $output .= '';

  return $output;
}
