<?php
/**
* Popular Posts Widget
*/


class pm_popular_posts extends WP_Widget {

	/**
	* Register widget with WordPress.
	*/

	function __construct() {
		parent::__construct(
			'pm_popular_posts',
			esc_html__( 'Purism: Popular Posts', 'purism' ),
			array( 'description' => esc_html__( 'Retrieves a list of the populuar posts filtered by views or likes.', 'purism' ), )
		);
	}

	/**
	* Front-end display of widget
	*/

	public function widget( $args, $instance ) {
		$title 	= apply_filters( 'widget_title', $instance['title'] );
		$number = ! empty( $instance['number'] ) &&  $instance['number'] > 0 ? $instance['number'] : 2;
		$filter = $instance['filter'];
		$layout = $instance['layout'];

		$query = array(
			'posts_per_page' 			=> $number,
			'meta_key' 						=> $filter,
			'orderby' 						=> 'meta_value_num',
			'order' 							=> 'DESC',
			'ignore_sticky_posts' => true
		);

		$popular = new WP_Query( $query );

		echo $args['before_widget'];
		if ( !empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>

		<?php if ( ! empty( $layout ) ) {
			$layout_class = ' ' . $layout;
		} else {
			$layout_class = ' pp-grid';
		} ?>

		<?php if ( $popular->have_posts()) : ?>
			<div class="popular-posts-widget<?php echo esc_attr( $layout_class ); ?>">
				<ul>
					<?php while ( $popular->have_posts() ) : $popular->the_post(); ?>
						<li>
							<article <?php post_class(); ?>>
								<div class="pp-item">

									<?php if ( has_post_thumbnail() ) : ?>
										<div class="pp-image">
											<a href="<?php the_permalink();?>"><?php the_post_thumbnail( 'pm-small-thumb' ); ?></a>
										</div>
									<?php endif; ?>

									<div class="pp-content">
										<h5><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h5>
										<p class="posted-info">
											<?php pm_post_date(); ?>
										</p>
									</div>

								</div>
							</article>
						</li>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>

				</ul>
			</div>

		<?php else : ?>

			<?php esc_html_e( 'No Posts are found.', 'purism' ); ?>

		<?php endif; ?>

		<?php echo $args['after_widget'];
	}

	/**
	* Back-end widget form
	*/

	public function form( $instance ) {

		$defaults = array(
			'title' 	=> esc_attr__( 'Popular Posts', 'purism' ),
			'filter' 	=> 'post_views_count',
			'number' 	=> 2,
			'layout' 	=> 'pp-grid'
		);
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'purism' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'filter' ) ); ?>"><?php esc_html_e( 'Filter by:', 'purism' ); ?>
				<select class='widefat' id="<?php echo esc_attr( $this->get_field_id( 'filter' ) ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'filter' ) ); ?>" type="text">
					<option value="post_views_count" <?php echo ( $instance['filter'] == 'post_views_count' ) ? 'selected' : ''; ?>>
					 	<?php esc_html_e( 'Views', 'purism' ); ?>
					</option>
					<option value="_post_like_count" <?php echo ( $instance['filter'] == '_post_like_count' )? 'selected' : ''; ?>>
						<?php esc_html_e( 'Likes', 'purism' ); ?>
					</option>
				</select>
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of Posts:', 'purism' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" min="1" max="6" value="<?php echo esc_attr( $instance['number'] ); ?>"/>
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
		$instance 					= $old_instance;
		$instance['title'] 	= sanitize_text_field( $new_instance['title'] );
		$instance['filter'] = $new_instance['filter'];
		$instance['number'] = ( ! empty( $new_instance['number'] ) &&  $new_instance['number'] > 0 ) ? sanitize_text_field( $new_instance['number'] ) : 2;
		$instance['layout'] = sanitize_text_field( $new_instance['layout'] );

		return $instance;
	}
}
