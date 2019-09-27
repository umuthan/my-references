<?php

// Register and load the widget
function my_references_load_widget() {
  register_widget( 'my_references_widget' );
}
add_action( 'widgets_init', 'my_references_load_widget' );

// Creating the widget
class my_references_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      // Base ID of your widget
      'my_references_widget',

      // Widget name will appear in UI
      __('My References Widget', 'my_references_widget_domain'),

      // Widget description
      array( 'description' => __( 'Reference list widget', 'my_references_widget_domain' ), )
    );
  }

  // Creating widget front-end

  public function widget($args, $instance) {
    $title = apply_filters( 'widget_title', $instance['title'] );

    // before and after widget arguments are defined by themes
    echo $args['before_widget'];
    if ( ! empty( $title ) )
      echo $args['before_title'] . $title . $args['after_title'];

    // This is where you run the code and display the output
    echo __( 'Hello, World!', 'my_references_widget_domain' );
    echo $args['after_widget'];
  }

  // Widget Backend
  public function form($instance) {
    if ( isset( $instance[ 'title' ] ) ) {
      $title = $instance[ 'title' ];
      $number = $instance[ 'number' ];
    } else {
      $title = __( 'References', 'my_references_widget_domain' );
      $number = 5;
    }
    // Widget admin form
    echo '<p>
    <label for="'.$this->get_field_id( 'title' ).'">'.__( 'Title:' ).'</label>
    <input class="widefat" id="'.$this->get_field_id( 'title' ).'" name="'.$this->get_field_name( 'title' ).'" type="text" value="'.esc_attr( $title ).'" />
    </p>
    <p>
    <label for="'.$this->get_field_id( 'number' ).'">'.__( 'Number of references:', 'my_references_widget_domain' ).'</label>
    <input class="widefat" id="'.$this->get_field_id( 'number' ).'" name="'.$this->get_field_name( 'number' ).'" type="number" value="'.esc_attr( $number ).'" />
    </p>';
  }

  // Updating widget replacing old instances with new
  public function update($new_instance, $old_instance) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';

    return $instance;
  }
} // Class my_references_widget ends here
