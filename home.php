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

get_header(); ?>

	<div id="primary" class="content-area homepage">
		<div id="content" class="site-content" role="main">
			<div class="entry-meta widget-area" id="sidebar-home" role="complementary">
				<hgroup>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</hgroup>
				<?php dynamic_sidebar( 'sidebar-home' ); ?>
			</div><!-- .entry-meta -->

			<div class="homepage-post">
				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
							/* Include the Post-Format-specific template for the content.
							 * If you want to overload this in a child theme then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'teaser', get_post_format() );
						?>
						<?php break; ?>

					<?php endwhile; ?>
				<?php else : ?>

					<?php get_template_part( 'no-results', 'index' ); ?>

				<?php endif; ?>
			</div>
		</div><!-- #content -->
		<div id="featured-categories">
			<?php
			
			$featured_category_ids = array( 552, 76, 499 );
			shuffle( $featured_category_ids );
			
			$exclude_posts = array();
			
			foreach ( $featured_category_ids as $featured_category_id ) {
				$category = get_category( $featured_category_id );
				
				?>
				<div>
					<span class="category-name"><a href="<?php echo esc_url( get_category_link( $featured_category_id ) ); ?>"><?php echo esc_html( $category->name ); ?></a></span>
					<?php
					
					$args = array(
						'cat' => $featured_category_id,
						'posts_per_page' => 3,
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
			<?php } ?>
		</div>
	</div><!-- #primary -->
<?php get_footer(); ?>