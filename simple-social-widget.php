<?php
/**
 * Simple Social Sharing Widget
 */

class Simple_Social_Widget extends WP_Widget {

	/**
	 * Constructor for our widget class.
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'Simple_widget_social',
			'description' => __( "Simple Social Sharing Widget.")
		);
		parent::__construct( 'simple-social', _x( '01 - Social Sharing', 'simple Social widget' ), $widget_ops );
	}

	/**
	 * Outputs the content for the current social widget instance.
	 */
	public function widget( $args, $instance ) {
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$facebook = apply_filters( 'facebook_url', empty( $instance['facebook'] ) ? '' : $instance['facebook'], $instance, $this->id_base );
		$twitter = apply_filters( 'twitter_url', empty( $instance['twitter'] ) ? '' : $instance['twitter'], $instance, $this->id_base );
		$googlep = apply_filters( 'googlep_url', empty( $instance['googlep'] ) ? '' : $instance['googlep'], $instance, $this->id_base );
		$pinterest = apply_filters( 'pinterest_url', empty( $instance['pinterest'] ) ? '' : $instance['pinterest'], $instance, $this->id_base );
		$instagram = apply_filters( 'instagram_url', empty( $instance['instagram'] ) ? '' : $instance['instagram'], $instance, $this->id_base );

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>

		<ul class="connect-social list-unstyled list-inline">
			<!-- facebook -->
			<?php if ( !empty( $facebook ) ):
				echo '<li><a href="'.esc_url( $facebook ).'"><i class="fa fa-facebook"></i></a></li>';
			endif; ?>

			<!-- twitter -->
			<?php if ( !empty( $twitter ) ):
				echo '<li><a href="'.esc_url( $twitter ).'"><i class="fa fa-twitter"></i></a></li>';
			endif; ?>

			<!-- google plus -->
			<?php if ( !empty( $googlep ) ):
				echo '<li><a href="'.esc_url( $googlep ).'"><i class="fa fa-google-plus"></i></a></li>';
			endif; ?>

			<!-- pinterest -->
			<?php if ( !empty( $pinterest ) ):
				echo '<li><a href="'.esc_url( $pinterest ).'"><i class="fa fa-pinterest"></i></a></li>';
			endif; ?>

			<!-- instagram -->
			<?php if ( !empty( $instagram ) ):
				echo '<li><a href="'.esc_url( $instagram ).'"><i class="fa fa-instagram"></i></a></li>';
			endif; ?>
		</ul>
		<!-- connect-social -->

		<?php
		echo $args['after_widget'];
	}

	/**
	 * Outputs the settings form for the Search widget.
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, 
			array( 
				'title' => '',
				'facebook' => '',
				'twitter' => '',
				'googlep' => '',
				'pinterest' => '',
				'instagram' => ''
			)
		);
		$title = $instance['title'];
		$facebook = $instance['facebook'];
		$twitter = $instance['twitter'];
		$googlep = $instance['googlep'];
		$pinterest = $instance['pinterest'];
		$instagram = $instance['instagram'];
		?>

		<!-- title -->
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title :'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</label></p>

		<!-- facebook -->
		<p><label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook URL :'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" />
		</label></p>
		<!-- twitter -->
		<p><label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter URL :'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" />
		</label></p>
		<!-- google plus -->
		<p><label for="<?php echo $this->get_field_id('googlep'); ?>"><?php _e('Google Plus URL :'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('googlep'); ?>" name="<?php echo $this->get_field_name('googlep'); ?>" type="text" value="<?php echo esc_attr($googlep); ?>" />
		</label></p>
		<!-- pinterest -->
		<p><label for="<?php echo $this->get_field_id('pinterest'); ?>"><?php _e('Pinterest URL :'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>" name="<?php echo $this->get_field_name('pinterest'); ?>" type="text" value="<?php echo esc_attr($pinterest); ?>" />
		</label></p>
		<!-- instagram -->
		<p><label for="<?php echo $this->get_field_id('instagram'); ?>"><?php _e('Instagram URL :'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" name="<?php echo $this->get_field_name('instagram'); ?>" type="text" value="<?php echo esc_attr($instagram); ?>" />
		</label></p>
		<?php
	}

	/**
	 * Handles updating settings for the current social widget instance.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, 
			array( 
				'title' => '',
				'facebook' => '',
				'twitter' => '',
				'googlep' => '',
				'pinterest' => '',
				'instagram' => '',
			)
		);
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['facebook'] = sanitize_text_field( $new_instance['facebook'] );
		$instance['twitter'] = sanitize_text_field( $new_instance['twitter'] );
		$instance['googlep'] = sanitize_text_field( $new_instance['googlep'] );
		$instance['pinterest'] = sanitize_text_field( $new_instance['pinterest'] );
		$instance['instagram'] = sanitize_text_field( $new_instance['instagram'] );
		return $instance;
	}

}

// register widget on widgets_init hook.
add_action( 'widgets_init', 'simple_reg_social_widget' );
function simple_reg_social_widget() {
	register_widget( 'Simple_Social_Widget' );
}
