<?php

/* My References Post Type */
add_action( 'init', 'my_references_create_reference_post_type' );
function my_references_create_reference_post_type() {
  register_post_type( 'reference',
    array(
      'labels' => array(
        'name' => __( 'References' ),
        'singular_name' => __( 'Reference' )
      ),
      'public' => true,
      'has_archive' => false,
      'exclude_from_search' => true,
      'supports' => array( 'title', 'thumbnail', 'editor', 'custom-fields', 'page-attributes' )
    )
  );
  flush_rewrite_rules();
}
/* My References Post Type */
