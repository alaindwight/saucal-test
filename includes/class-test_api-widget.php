<?php

/**
 * Class for api widget.
 *
 * @link       alaindwight.com
 * @since      1.0.0
 *
 * @package    Test_api
 * @subpackage Test_api/includes
 */

/**
 * Class for api widget.
 *
 * A widget that displays tweets via api.
 *
 * @package    Test_api
 * @subpackage Test_api/includes
 * @author     Alain Dwight <alaindwight@gmail.com>
 */

// Creating the widget 
class api_widget extends WP_Widget {
  
	function __construct() {
	parent::__construct(
	  
	// Base ID of your widget
	'api_widget', 
	  
	// Widget name will appear in UI
	__('API Widget', 'api_widget_domain'), 
	  
	// Widget description
	array( 'description' => __( 'A widget to display tweets via API', 'api_widget_domain' ), ) 
	);
	}
	  
	// Creating widget front-end	  
	public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $response = api_call()->json;

        // don't display the widget if there is no response
        if ( !$response ) { return; }
        
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
        
        // This is where you run the code and display the output
        echo "<ul>";
        foreach($response as $tweet) {
            if ($tweet->response_or_request === 'request') { continue; }
            $name = filter_var($tweet->user->name, FILTER_SANITIZE_STRING);
            $text = filter_var($tweet->text, FILTER_SANITIZE_STRING);
            echo "<li>$name : $text </li>";
        }
        echo "</ul>";
        echo $args['after_widget'];
	}
			  
	// Widget Backend 
	public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
        $title = $instance[ 'title' ];
        }
        else {
        $title = __( 'New title', 'api_widget_domain' );
        }
        // Widget admin form
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
	<?php 
	}
		  
	// Replace old instances with new
	public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
	}
	 

} 
	 
// Register and load the widget
function api_load_widget() {
	register_widget( 'api_widget' );
}

