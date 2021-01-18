<?php
/**
 * The homepage template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

// Posts that shouldn't be included in the featured section.
// To start, don't show the most recent post, since it's at the top of the page.
// Then, make sure we don't duplicate posts across the sections.
$exclude_posts = array();

get_header();

?>

	<div id="ryuki-primary" class="ryuki-content-area homepage">
		<div id="ryuki-content" class="ryuki-site-content">
			<div id="sidebar-home" role="complementary">
				<hgroup>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</hgroup>
				<?php dynamic_sidebar( 'sidebar-home' ); ?>
				<div class="ryuki-featured-categories">
					<div>
						<span class="category-name">
							<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>"><?php echo esc_html__( 'Recent Posts', 'ryuki' ); ?></a>
						</span>
						<?php

						$args = array(
							'posts_per_page' => 6,
							'offset' => 1,
							'post__not_in' => $exclude_posts,
						);

						$the_query = new WP_Query( $args );

						// The Loop
						if ( $the_query->have_posts() ) {
							while ( $the_query->have_posts() ) {
								$the_query->the_post();

								$exclude_posts[] = $post->ID;

								get_template_part( 'featured-on-homepage' );
							}
						}

						?>
					</div>
				</div>
			</div>

			<div class="homepage-post" role="main">
				<span class="latest-header">
					<a>
						<?php echo esc_html__( 'The Latest', 'ryuki' ); ?>
					</a>
				</span>
				<?php

				$args = array(
					'posts_per_page' => 1,
					'paged' => max( get_query_var( 'page' ), 1 ),
				);

				$the_query = new WP_Query( $args );

				// The Loop
				if ( $the_query->have_posts() ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();

						$exclude_posts[] = $post->ID;

						get_template_part( 'teaser', get_post_format() );
					}
				}
				else {
					get_template_part( 'no-results', 'index' );
				}

				?>
			</div>
		</div><!-- #content -->
		<?php

		$featured_category_ids = array(
			get_theme_mod( 'ryuki_featured_category_1' ),
			get_theme_mod( 'ryuki_featured_category_2' ),
			get_theme_mod( 'ryuki_featured_category_3' ),
		);

		if ( ! empty( $featured_category_ids ) ) {
			?>
			<div id="ryuki-featured-categories">
				<?php

				foreach ( $featured_category_ids as $featured_category_id ) {
					?>
					<div>
						<span class="category-name">
							<?php

							if ( $featured_category_id ) {
								$category = get_category( $featured_category_id );
								?>
								<a href="<?php echo esc_url( get_category_link( $featured_category_id ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
								<?php
							}
							else {
								?>
								<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>"><?php echo esc_html__( 'Recent Posts', 'ryuki' ); ?></a>
								<?php
							}

							?>
						</span>
						<?php

						$args = array(
							'posts_per_page' => 3,
							'post__not_in' => $exclude_posts,
						);

						if ( $featured_category_id ) {
							$args['cat'] = $featured_category_id;
						}

						$the_query = new WP_Query( $args );

						// The Loop
						if ( $the_query->have_posts() ) {
							while ( $the_query->have_posts() ) {
								$the_query->the_post();

								$exclude_posts[] = $post->ID;

								get_template_part( 'featured-on-homepage' );
							}
						}

						?>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	</div><!-- #primary -->
<?php get_footer(); ?>