<?php
/**
* Recent Posts Widget
*/

class pm_recent_posts extends WP_Widget {

	/**
	* Register widget with WordPress.
	*/
	function __construct() {
		parent::__construct(
			'pm_recent_posts',
			esc_html__( 'Purism: Recent Posts', 'purism' ),
			array( 'description' => esc_html__( 'Retrieves a list of the most recent posts from all or a certain category or tag.', 'purism' ), )
		);
	}

	/**
	* Front-end display of widget
	*/
	public function widget( $args, $instance ) {
		$title 			= apply_filters( 'widget_title', $instance['title'] );
		$thumbnail 	= $instance['thumbnail'];
		$category 	= pm_language_object_id( $instance['category'], 'category' );
		$tag 				= $instance['tag'];
		$number 		= ! empty( $instance['number'] ) &&  $instance['number'] > 0 ? $instance['number'] : 3;
		$layout 		= $instance['layout'];
		$query 			= array( 'posts_per_page' => $number, 'ignore_sticky_posts' => true, 'category__in' => $category, 'tag__in' => $tag);
		$recent 		= new WP_Query($query);

		echo $args['before_widget'];
		if ( !empty($title) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>

		<?php if ( ! empty( $layout ) ) {
			$layout_class = ' ' . $layout;
		} else {
			$layout_class = ' pp-list';
		} ?>

		<?php if ( $recent->have_posts()) { ?>
			<div  class="recent-posts-widget<?php echo esc_attr( $layout_class ); ?>">
				<ul>
					<?php while ( $recent->have_posts() ) : $recent->the_post(); ?>
						<li>
							<article <?php post_class(); ?>>
								<?php if ( has_post_thumbnail() && $instance['thumbnail'] ) { ?>
									<div class="rp-image">
										<a href="<?php the_permalink();?>"><?php the_post_thumbnail( 'pm-small-thumb' ); ?></a>
									</div>
									<?php
								} ?>
								<div class="rp-content">
									<h5><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h5>
									<p class="posted-info">
										<?php pm_post_date(); ?>
									</p>
								</div>
							</article>
						</li>
					<?php endwhile; ?>
				</ul>
			</div>
			<?php wp_reset_postdata(); ?>

			<?php
		} else {

			esc_html_e( 'No Posts are found.', 'purism' );

		} ?>

		<?php echo $args['after_widget'];
	}

	/**
	* Back-end widget form
	*/
	public function form( $instance ) {

		$defaults = array(
			'title' 		=> esc_attr__( 'Recent Posts', 'purism' ),
			'number' 		=> 3,
			'category' 	=> '-1',
			'tag' 			=> '',
			'thumbnail' => 0,
			'layout' 		=> 'pp-list'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>



		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'purism' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('category') ); ?>"><?php esc_html_e( 'Filter by Category:', 'purism' ); ?> </label><br>

			<?php
			$selected_cat = pm_language_object_id( $instance['category'], 'category' );
			$args = array(
				'id' 								=> $this->get_field_id('category'),
				'name' 							=> $this->get_field_name('category'),
				'show_option_none' 	=>  esc_html__( 'No Selection', 'purism' ),
				'option_none_value' => '',
				'selected' 					=> 	$selected_cat,
				'class' 						=> 'widefat',
				'orderby' 					=> 'name',
			);

			wp_dropdown_categories( $args );
			?>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('tag') ); ?>"><?php esc_attr_e( 'Filter by Tag:', 'purism' ); ?> </label><br>

			<?php
			$selected_tag = pm_language_object_id( $instance['tag'], 'post_tag' );;
			$args = array(
				'id' 								=> $this->get_field_id('tag'),
				'name' 							=> $this->get_field_name('tag'),
				'show_option_none' 	=>  esc_html__('No Selection', 'purism'),
				'option_none_value' => '',
				'taxonomy'					=> 'post_tag',
				'selected' 					=> $selected_tag,
				'class' 						=> 'widefat',
				'orderby' 					=> 'name',
			);
			wp_dropdown_categories( $args ); ?>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of Posts:', 'purism' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" min="1" max="6" value="<?php echo esc_attr( $instance['number'] ); ?>"/>

		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'thumbnail' ) ); ?>"><?php esc_html_e( 'Thumbnail:', 'purism' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'thumbnail' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumbnail' ) ); ?>" type="checkbox" <?php checked( $instance['thumbnail'] ); ?>>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"><?php esc_html_e( 'Layout:', 'purism' ); ?>
				<select class='widefat' id="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>" type="text">
					<option value="pp-grid" <?php echo ( $instance['layout'] == 'pp-grid' ) ? 'selected' : ''; ?>>
						<?php esc_html_e( 'Grid', 'purism' ); ?>
					</option>
					<option value="pp-list" <?php echo ( $instance['layout'] == 'pp-list' )? 'selected' : ''; ?>>
						<?php esc_html_e( 'List', 'purism' ); ?>
					</option>
				</select>
			</label>
		</p>

		<?php
	}

	/**
	* Update the widget settings.
	*/
	public function update( $new_instance, $old_instance ) {

		$instance 							= $old_instance;
		$instance['title'] 			= sanitize_text_field( $new_instance['title'] );
		$instance['category'] 	= $new_instance['category'];
		$instance['tag'] 				= $new_instance['tag'];
		$instance['number'] 		= ( ! empty( $new_instance['number'] ) &&  $new_instance['number'] > 0 ) ? sanitize_text_field( $new_instance['number'] ) : 3;
		$instance['thumbnail'] 	= ( ! empty( $new_instance['thumbnail'] ) ) ? 1 : 0;
		$instance['layout'] 		= sanitize_text_field( $new_instance['layout'] );

		return $instance;
	}
}
