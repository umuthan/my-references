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
      __('My References Widget', 'my-references'),

      // Widget description
      array( 'description' => __( 'Reference list widget', 'my-references' ), )
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
    echo get_references($instance['show_title'], $instance['show_image'], $instance['animation'], $instance['number'], $instance['image_style']);
    echo $args['after_widget'];
  }

  // Widget Backend
  public function form($instance) {
    if ( isset( $instance[ 'title' ] ) ) {
      $title = $instance[ 'title' ];
      $showTitle = $instance[ 'show_title' ];
      $showImage = $instance[ 'show_image' ];
      $animation = $instance[ 'animation' ];
      $number = $instance[ 'number' ];
      $imageStyle = $instance[ 'image_style' ];
      $classes = $instance[ 'classes' ];
    } else {
      $title = __( 'References', 'my-references' );
      $showTitle = 'no';
      $showImage = 'yes';
      $animation = 'carousel';
      $number = -1;
      $imageStyle = 'thumbnail';
      $classes = '';
    }
    // Widget admin form
    echo '<p>
    <label for="'.$this->get_field_id( 'title' ).'">'.__( 'Title:' ).'</label>
    <input class="widefat" id="'.$this->get_field_id( 'title' ).'" name="'.$this->get_field_name( 'title' ).'" type="text" value="'.esc_attr( $title ).'" />
    </p>
    <p>
    <label for="'.$this->get_field_id( 'show_title' ).'">'.__( 'Show Title of References:', 'my-references' ).'</label>
    <input type="checkbox" class="widefat" id="'.$this->get_field_id( 'show_title' ).'" name="'.$this->get_field_name( 'show_title' ).'" value="yes"';
    if(esc_attr($showTitle)=='yes') echo ' checked';
    echo '>
    </p>
    <p>
    <label for="'.$this->get_field_id( 'show_image' ).'">'.__( 'Show Image of References:', 'my-references' ).'</label>
    <input type="checkbox" class="widefat" id="'.$this->get_field_id( 'show_image' ).'" name="'.$this->get_field_name( 'show_image' ).'" value="yes"';
    if(esc_attr($showImage)=='yes') echo ' checked';
    echo '>
    </p>
    <p>
    <label for="'.$this->get_field_id( 'animation' ).'">'.__( 'Animation:', 'my-references' ).'</label>';
    echo '<select class="widefat" id="'.$this->get_field_id( 'animation' ).'" name="'.$this->get_field_name( 'animation' ).'">';
      echo '<option value="carousel"';
      if('animation' == esc_attr($animation)) echo ' selected';
      echo '>Carousel</option>';
      echo '<option value="no"';
      if('no' == esc_attr($animation)) echo ' selected';
      echo '>No</option>';
    echo '</select>
    </p>
    <p>
    <label for="'.$this->get_field_id( 'number' ).'">'.__( 'Number of references:', 'my-references' ).'</label>
    <input class="widefat" id="'.$this->get_field_id( 'number' ).'" name="'.$this->get_field_name( 'number' ).'" type="number" value="'.esc_attr( $number ).'" />
    </p>
    <p>
    <label for="'.$this->get_field_id( 'image_style' ).'">'.__( 'Image Style:', 'my-references' ).'</label>';
    $imageStyles = get_all_image_sizes();
    echo '<select class="widefat" id="'.$this->get_field_id( 'image_style' ).'" name="'.$this->get_field_name( 'image_style' ).'">';
    foreach ($imageStyles as $key => $value) {
      echo '<option value="'.$key.'"';
      if($key == esc_attr($imageStyle)) echo ' selected';
      echo '>'.$key.'</option>';
    }
    echo '</select>
    </p>
    <p>
    <label for="'.$this->get_field_id( 'classes' ).'">'.__( 'Classes:', 'my-references' ).'</label>
    <input class="widefat" id="'.$this->get_field_id( 'classes' ).'" name="'.$this->get_field_name( 'classes' ).'" type="text" value="'.esc_attr( $classes ).'" />
    </p>';
  }

  // Updating widget replacing old instances with new
  public function update($new_instance, $old_instance) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['show_image'] = ( ! empty( $new_instance['show_image'] ) ) ? strip_tags( $new_instance['show_image'] ) : '';
    $instance['show_title'] = ( ! empty( $new_instance['show_title'] ) ) ? strip_tags( $new_instance['show_title'] ) : '';
    $instance['animation'] = ( ! empty( $new_instance['animation'] ) ) ? strip_tags( $new_instance['animation'] ) : '';
    $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
    $instance['image_style'] = ( ! empty( $new_instance['image_style'] ) ) ? strip_tags( $new_instance['image_style'] ) : '';
    $instance['classes'] = ( ! empty( $new_instance['classes'] ) ) ? strip_tags( $new_instance['classes'] ) : '';

    return $instance;
  }
} // Class my_references_widget ends here
